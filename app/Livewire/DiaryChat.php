<?php

namespace App\Livewire;

use App\Services\DiaryAgent\DiaryAgentService;
use App\Services\DiaryAgent\WhisperService;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class DiaryChat extends Component
{
    public string $date;

    public ?string $activeMeal = null;

    public array $messages = [];

    public bool $isProcessing = false;

    public function mount(string $date)
    {
        $this->date = $date;
    }

    /**
     * Update the active meal context
     */
    #[On('meal-selected')]
    public function setActiveMeal(?string $meal = null): void
    {
        $this->activeMeal = $meal;
    }

    /**
     * Update the date context
     */
    #[On('date-changed')]
    public function setDate(?string $date = null): void
    {
        if ($date) {
            $this->date = $date;
        }
    }

    /**
     * Process a text message from the user
     */
    public function sendMessage(string $text): void
    {
        if (empty(trim($text))) {
            return;
        }

        $this->isProcessing = true;

        // Add user message to chat
        $this->messages[] = [
            'role' => 'user',
            'content' => $text,
            'timestamp' => now()->toIso8601String(),
        ];

        try {
            $agent = app(DiaryAgentService::class);
            $result = $agent->process($text, [
                'date' => $this->date,
                'activeMeal' => $this->activeMeal,
                'userId' => auth()->id(),
                'messages' => $this->messages, // Pass conversation history
            ]);

            // Add assistant response
            $this->messages[] = [
                'role' => 'assistant',
                'content' => $result->message,
                'timestamp' => now()->toIso8601String(),
            ];

            // Always refresh the diary after successful AI response
            // (the AI likely made changes if the user asked for something)
            $this->dispatch('diary-updated');

        } catch (\Exception $e) {
            Log::error('DiaryChat error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            $this->messages[] = [
                'role' => 'assistant',
                'content' => __('Sorry, something went wrong. Please try again.'),
                'error' => true,
                'timestamp' => now()->toIso8601String(),
            ];
        }

        $this->isProcessing = false;
    }

    /**
     * Process audio from the user
     */
    public function processAudio(string $audioBase64, ?string $mimeType = null): void
    {
        $this->isProcessing = true;

        try {
            $whisper = app(WhisperService::class);
            $transcription = $whisper->transcribe($audioBase64, $mimeType);

            // Dispatch event so the frontend can show the transcription
            // in the input field for editing before sending
            $this->dispatch('transcription-ready', text: $transcription);

        } catch (\Exception $e) {
            Log::error('Whisper transcription error', [
                'message' => $e->getMessage(),
                'mimeType' => $mimeType,
            ]);

            $this->dispatch('transcription-error', message: __('Could not transcribe audio. Please try again.'));
        }

        $this->isProcessing = false;
    }

    /**
     * Clear chat history
     */
    public function clearChat(): void
    {
        $this->messages = [];
    }

    public function render()
    {
        return view('livewire.diary-chat');
    }
}

