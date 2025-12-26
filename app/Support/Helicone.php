<?php

namespace App\Support;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class Helicone
{
    public static function enabled(): bool
    {
        return (bool) config('helicone.enabled', false)
            && (string) config('helicone.api_key', '') !== '';
    }

    /**
     * Build Helicone headers for an LLM request.
     *
     * @param  array<string, scalar|null>  $properties  Custom properties (Helicone-Property-*)
     * @param  array<string, scalar|null>  $sessionProperties  Session properties JSON
     * @return array<string, string>
     */
    public static function headers(
        ?string $sessionId = null,
        ?string $sessionPath = null,
        ?string $targetUrl = null,
        array $properties = [],
        array $sessionProperties = [],
    ): array {
        if (! self::enabled()) {
            return [];
        }

        $apiKey = (string) config('helicone.api_key', '');

        $headers = [
            'Helicone-Auth' => 'Bearer '.$apiKey,
        ];

        if ($sessionId) {
            $headers['Helicone-Session-Id'] = $sessionId;
        }

        if ($sessionPath) {
            $headers['Helicone-Session-Path'] = $sessionPath;
        }

        if ($targetUrl) {
            $headers['Helicone-Target-URL'] = $targetUrl;
        }

        if (! empty($sessionProperties)) {
            // Helicone expects JSON for session properties.
            $headers['Helicone-Session-Properties'] = json_encode(
                $sessionProperties,
                JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            ) ?: '{}';
        }

        foreach ($properties as $k => $v) {
            if ($v === null) {
                continue;
            }
            $key = trim((string) $k);
            if ($key === '') {
                continue;
            }
            $headers['Helicone-Property-'.$key] = (string) $v;
        }

        return $headers;
    }

    /**
     * Helicone gateway expects a target URL (provider base).
     */
    public static function openAiTargetUrl(): string
    {
        // Prefer explicit OpenAI URL if set; strip any trailing "/v1" path.
        $url = (string) env('OPENAI_URL', 'https://api.openai.com/v1');
        $url = rtrim($url, '/');

        if (str_ends_with($url, '/v1')) {
            $url = substr($url, 0, -3);
        }

        return rtrim($url, '/').'/';
    }

    /**
     * Send a Manual Logger event to Helicone.
     *
     * This is useful when proxy-based logging is not possible (e.g. multipart uploads).
     * We intentionally keep this best-effort and never throw.
     *
     * @param  array<string, mixed>  $providerRequestJson
     * @param  array<string, string>  $meta
     * @param  array<string, mixed>|null  $providerResponseJson
     */
    public static function manualLog(
        string $url,
        array $providerRequestJson,
        array $meta,
        int $status,
        array $responseHeaders = [],
        ?array $providerResponseJson = null,
        ?string $responseTextBody = null,
        ?array $timing = null,
    ): void {
        if (! self::enabled() || ! (bool) config('helicone.whisper_manual_log', true)) {
            return;
        }

        $endpoint = (string) config('helicone.custom_log_url', '');
        if ($endpoint === '') {
            return;
        }

        $payload = [
            'providerRequest' => [
                'url' => $url,
                'json' => $providerRequestJson,
                'meta' => $meta,
            ],
            'providerResponse' => array_filter([
                'headers' => $responseHeaders,
                'status' => $status,
                'json' => $providerResponseJson,
                'textBody' => $responseTextBody,
            ], fn ($v) => $v !== null),
        ];

        if ($timing) {
            $payload['timing'] = $timing;
        }

        try {
            Http::timeout(2)
                ->withHeaders([
                    'Authorization' => 'Bearer '.(string) config('helicone.api_key', ''),
                    'Content-Type' => 'application/json',
                ])
                ->post($endpoint, $payload);
        } catch (\Throwable) {
            // Never break product flow because of logging issues.
        }
    }

    /**
     * Default properties we generally want on every request.
     *
     * @return array<string, scalar|null>
     */
    public static function defaultProperties(array $extra = []): array
    {
        return array_merge([
            'App' => config('app.name'),
            'Environment' => app()->environment(),
            'UserId' => Auth::id(),
        ], $extra);
    }
}


