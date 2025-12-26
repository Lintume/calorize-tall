<?php

namespace App\Services\DiaryAgent;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhisperService
{
    /**
     * Transcribe audio to text using OpenAI Whisper API
     */
    public function transcribe(string $audioBase64, ?string $mimeType = null): string
    {
        // Decode base64 audio
        $audioData = base64_decode($audioBase64);

        if ($audioData === false) {
            throw new \InvalidArgumentException('Invalid base64 audio data');
        }

        $extension = $this->guessExtensionFromMime($mimeType);

        // Create a temporary file for the audio
        $tempFile = tempnam(sys_get_temp_dir(), 'audio_');
        $tempFilePath = $tempFile.'.'.$extension;
        rename($tempFile, $tempFilePath);
        file_put_contents($tempFilePath, $audioData);

        try {
            /** @var Response $response */
            $response = Http::withToken(config('prism.providers.openai.api_key'))
                ->timeout(30)
                ->attach(
                    'file',
                    file_get_contents($tempFilePath),
                    'audio.'.$extension
                )
                ->post('https://api.openai.com/v1/audio/transcriptions', [
                    'model' => 'whisper-1',
                    'language' => $this->detectLanguageHint(),
                ]);

            if (! $response->successful()) {
                Log::error('Whisper API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                throw new \RuntimeException('Failed to transcribe audio: '.$response->body());
            }

            return $response->json('text', '');
        } finally {
            // Clean up temp file
            if (file_exists($tempFilePath)) {
                unlink($tempFilePath);
            }
        }
    }

    private function guessExtensionFromMime(?string $mimeType): string
    {
        $mimeType = strtolower(trim((string) $mimeType));

        return match ($mimeType) {
            'audio/mp4' => 'mp4',
            'audio/m4a', 'audio/x-m4a' => 'm4a',
            'audio/mpeg', 'audio/mp3' => 'mp3',
            'audio/wav', 'audio/x-wav' => 'wav',
            'audio/aac' => 'aac',
            'audio/ogg', 'audio/opus' => 'ogg',
            'audio/webm' => 'webm',
            default => 'webm',
        };
    }

    /**
     * Transcribe audio from file path
     */
    public function transcribeFromFile(string $filePath): string
    {
        if (! file_exists($filePath)) {
            throw new \InvalidArgumentException("Audio file not found: {$filePath}");
        }

        /** @var Response $response */
        $response = Http::withToken(config('prism.providers.openai.api_key'))
            ->timeout(30)
            ->attach(
                'file',
                file_get_contents($filePath),
                basename($filePath)
            )
            ->post('https://api.openai.com/v1/audio/transcriptions', [
                'model' => 'whisper-1',
            ]);

        if (! $response->successful()) {
            throw new \RuntimeException('Failed to transcribe audio: '.$response->body());
        }

        return $response->json('text', '');
    }

    /**
     * Get language hint based on app locale
     */
    private function detectLanguageHint(): ?string
    {
        $locale = app()->getLocale();

        // Whisper supports auto-detection, but we can hint
        // to improve accuracy for Ukrainian
        return match ($locale) {
            'uk' => 'uk',
            'en' => 'en',
            default => null,
        };
    }
}

