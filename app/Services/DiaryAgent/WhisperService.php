<?php

namespace App\Services\DiaryAgent;

use App\Support\Helicone;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WhisperService
{
    /**
     * Transcribe audio to text using OpenAI Whisper API
     */
    public function transcribe(string $audioBase64, ?string $mimeType = null): string
    {
        $requestId = (string) Str::uuid();
        $startedAt = microtime(true);

        $mimeTypeNormalized = $this->normalizeMimeType($mimeType);
        $audioBase64 = $this->stripDataUrlPrefix($audioBase64);

        // Decode base64 audio
        $audioData = base64_decode($audioBase64, true);

        if ($audioData === false) {
            throw new \InvalidArgumentException('Invalid base64 audio data');
        }

        if (strlen($audioData) < 16) {
            throw new \InvalidArgumentException('Audio payload is empty or too small');
        }

        // Prefer server-side sniffed mime when possible (more reliable than browser-provided strings).
        $sniffedMime = $this->sniffMimeFromBytes($audioData);
        $effectiveMime = $sniffedMime ?: $mimeTypeNormalized;

        $extension = $this->guessExtensionFromMime($effectiveMime);
        $filePartContentType = $this->filePartContentType($effectiveMime, $extension);

        // Create a temporary file for the audio
        $tempFile = tempnam(sys_get_temp_dir(), 'audio_');
        $tempFilePath = $tempFile.'.'.$extension;
        rename($tempFile, $tempFilePath);
        file_put_contents($tempFilePath, $audioData);

        try {
            $useHeliconeGateway = Helicone::enabled() && (bool) config('helicone.whisper_use_gateway', false);
            $endpointBase = $useHeliconeGateway
                ? rtrim((string) config('helicone.gateway_url'), '/')
                : rtrim((string) config('prism.providers.openai.url'), '/');

            $endpoint = $endpointBase.'/audio/transcriptions';

            /** @var Response $response */
            $response = Http::withToken(config('prism.providers.openai.api_key'))
                ->withHeaders(Helicone::headers(
                    sessionId: $requestId,
                    sessionPath: 'diary_agent/whisper',
                    targetUrl: $useHeliconeGateway ? Helicone::openAiTargetUrl() : null,
                    properties: Helicone::defaultProperties([
                        'Feature' => 'diary_agent_whisper',
                        'RequestId' => $requestId,
                        'Locale' => app()->getLocale(),
                    ]),
                    sessionProperties: [
                        'feature' => 'diary_agent_whisper',
                        'locale' => app()->getLocale(),
                    ],
                ))
                ->timeout(30)
                ->attach(
                    'file',
                    file_get_contents($tempFilePath),
                    'audio.'.$extension,
                    [
                        'Content-Type' => $filePartContentType,
                    ]
                )
                ->post($endpoint, [
                    'model' => 'whisper-1',
                    'language' => $this->detectLanguageHint(),
                ]);

            if (! $response->successful()) {
                $this->manualHeliconeLogWhisper(
                    requestId: $requestId,
                    startedAt: $startedAt,
                    status: $response->status(),
                    providerRequest: [
                        'model' => 'whisper-1',
                        'language' => $this->detectLanguageHint(),
                        'file' => [
                            'filename' => 'audio.'.$extension,
                            'contentType' => $filePartContentType,
                            'bytes' => strlen($audioData),
                            'sniffedMime' => $sniffedMime,
                        ],
                    ],
                    providerResponseJson: $response->json(),
                    providerResponseText: $response->body(),
                );
                throw new \RuntimeException('Failed to transcribe audio: '.$response->body());
            }

            $text = $response->json('text', '');

            $this->manualHeliconeLogWhisper(
                requestId: $requestId,
                startedAt: $startedAt,
                status: $response->status(),
                providerRequest: [
                    'model' => 'whisper-1',
                    'language' => $this->detectLanguageHint(),
                    'file' => [
                        'filename' => 'audio.'.$extension,
                        'contentType' => $filePartContentType,
                        'bytes' => strlen($audioData),
                        'sniffedMime' => $sniffedMime,
                    ],
                ],
                providerResponseJson: ['text' => $text],
                providerResponseText: null,
            );

            return $text;
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
            'video/webm' => 'webm',
            'audio/webm' => 'webm',
            default => 'webm',
        };
    }

    /**
     * Transcribe audio from file path
     */
    public function transcribeFromFile(string $filePath): string
    {
        $requestId = (string) Str::uuid();

        if (! file_exists($filePath)) {
            throw new \InvalidArgumentException("Audio file not found: {$filePath}");
        }

        $useHeliconeGateway = Helicone::enabled() && (bool) config('helicone.whisper_use_gateway', false);
        $endpointBase = $useHeliconeGateway
            ? rtrim((string) config('helicone.gateway_url'), '/')
            : rtrim((string) config('prism.providers.openai.url'), '/');

        $endpoint = $endpointBase.'/audio/transcriptions';

        /** @var Response $response */
        $response = Http::withToken(config('prism.providers.openai.api_key'))
            ->withHeaders(Helicone::headers(
                sessionId: $requestId,
                sessionPath: 'diary_agent/whisper',
                targetUrl: $useHeliconeGateway ? Helicone::openAiTargetUrl() : null,
                properties: Helicone::defaultProperties([
                    'Feature' => 'diary_agent_whisper',
                    'RequestId' => $requestId,
                    'Locale' => app()->getLocale(),
                ]),
                sessionProperties: [
                    'feature' => 'diary_agent_whisper',
                    'locale' => app()->getLocale(),
                ],
            ))
            ->timeout(30)
            ->attach(
                'file',
                file_get_contents($filePath),
                basename($filePath)
            )
            ->post($endpoint, [
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

    private function normalizeMimeType(?string $mimeType): ?string
    {
        $mimeType = trim((string) $mimeType);
        if ($mimeType === '') {
            return null;
        }

        // Browser may send: "audio/webm;codecs=opus"
        $base = explode(';', strtolower($mimeType), 2)[0] ?? '';
        $base = trim($base);

        return $base !== '' ? $base : null;
    }

    private function stripDataUrlPrefix(string $base64OrDataUrl): string
    {
        $t = trim($base64OrDataUrl);

        // data:<mime>;base64,<payload>
        if (str_starts_with($t, 'data:')) {
            $pos = strpos($t, 'base64,');
            if ($pos !== false) {
                return substr($t, $pos + 7);
            }
        }

        return $t;
    }

    private function sniffMimeFromBytes(string $bytes): ?string
    {
        try {
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->buffer($bytes);
            if (is_string($mime) && $mime !== '') {
                return strtolower($mime);
            }
        } catch (\Throwable) {
            // ignore
        }

        return null;
    }

    private function filePartContentType(?string $mime, string $extension): string
    {
        $mime = strtolower((string) $mime);
        if ($mime !== '') {
            // Prefer audio/* even if browser reports video/webm.
            if ($mime === 'video/webm') {
                return 'audio/webm';
            }
            return $mime;
        }

        return match ($extension) {
            'mp3' => 'audio/mpeg',
            'wav' => 'audio/wav',
            'm4a' => 'audio/m4a',
            'mp4' => 'audio/mp4',
            'ogg' => 'audio/ogg',
            default => 'audio/webm',
        };
    }

    /**
     * Helicone manual logger fallback to ensure Whisper calls show up in Helicone even when multipart
     * proxy logging is unreliable.
     *
     * @param  array<string, mixed>  $providerRequest
     * @param  array<string, mixed>|null  $providerResponseJson
     */
    private function manualHeliconeLogWhisper(
        string $requestId,
        float $startedAt,
        int $status,
        array $providerRequest,
        ?array $providerResponseJson,
        ?string $providerResponseText,
    ): void {
        if (! Helicone::enabled() || ! (bool) config('helicone.whisper_manual_log', true)) {
            return;
        }

        $endedAt = microtime(true);
        $startMs = (int) round($startedAt * 1000);
        $endMs = (int) round($endedAt * 1000);

        $timing = [
            'startTime' => [
                'seconds' => (int) floor($startMs / 1000),
                'milliseconds' => $startMs % 1000,
            ],
            'endTime' => [
                'seconds' => (int) floor($endMs / 1000),
                'milliseconds' => $endMs % 1000,
            ],
        ];

        $meta = array_filter([
            'Helicone-Session-Id' => $requestId,
            'Helicone-Session-Path' => 'diary_agent/whisper',
            'Helicone-User-Id' => (string) (Auth::id() ?? ''),
            'Helicone-Property-Feature' => 'diary_agent_whisper',
            'Helicone-Property-RequestId' => $requestId,
            'Helicone-Property-Locale' => (string) app()->getLocale(),
            'Helicone-Property-App' => (string) config('app.name'),
            'Helicone-Property-Environment' => (string) app()->environment(),
        ], fn ($v) => $v !== '');

        Helicone::manualLog(
            url: 'openai/audio/transcriptions',
            providerRequestJson: $providerRequest,
            meta: $meta,
            status: $status,
            responseHeaders: [],
            providerResponseJson: $providerResponseJson,
            responseTextBody: $providerResponseText ? substr($providerResponseText, 0, 2000) : null,
            timing: $timing,
        );
    }
}

