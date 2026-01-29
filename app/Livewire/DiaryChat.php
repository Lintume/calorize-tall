<?php

namespace App\Livewire;

use App\Services\DiaryAgent\DiaryAgentService;
use App\Services\DiaryAgent\WhisperService;
use App\Services\PostHogService;
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

        // Track chat component mounted (user sees the chat)
        app(PostHogService::class)->captureForUser('diary_chat_opened', [
            'date' => $date,
        ]);
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

        try {
            $agent = app(DiaryAgentService::class);
            /** @var int|null $userId */
            $userId = auth()->id();
            $result = $agent->process($text, [
                'date' => $this->date,
                'activeMeal' => $this->activeMeal,
                'userId' => $userId,
                'messages' => $this->messages, // Pass conversation history (without current message)
            ]);

            // Add user message to chat AFTER processing (to avoid duplication)
            $this->messages[] = [
                'role' => 'user',
                'content' => $text,
                'timestamp' => now()->toIso8601String(),
            ];

            // Add assistant response
            $this->messages[] = [
                'role' => 'assistant',
                'content' => $result->message,
                'timestamp' => now()->toIso8601String(),
            ];

            // Track successful message
            app(PostHogService::class)->captureForUser('diary_chat_message_sent', [
                'message_length' => strlen($text),
                'has_actions' => !empty($result->actions),
                'actions_count' => count($result->actions ?? []),
            ]);

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

            // Track voice message usage
            app(PostHogService::class)->captureForUser('diary_chat_voice_used', [
                'transcription_length' => strlen($transcription),
            ]);

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

