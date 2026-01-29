<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PostHogService
{
    private string $apiKey;
    private string $host;
    private bool $enabled;

    public function __construct()
    {
        $this->apiKey = config('posthog.api_key', '');
        $this->host = config('posthog.host', 'https://eu.i.posthog.com');
        $this->enabled = config('posthog.enabled', true) && !empty($this->apiKey);
    }

    /**
     * Capture a custom event from the backend.
     */
    public function capture(string $distinctId, string $event, array $properties = []): void
    {
        if (!$this->enabled) {
            return;
        }

        try {
            Http::post("{$this->host}/capture/", [
                'api_key' => $this->apiKey,
                'event' => $event,
                'distinct_id' => $distinctId,
                'properties' => array_merge($properties, [
                    '$lib' => 'php',
                    '$lib_version' => '1.0.0',
                ]),
                'timestamp' => now()->toIso8601String(),
            ]);
        } catch (\Exception $e) {
            Log::warning('PostHog capture failed', [
                'event' => $event,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Identify a user with properties.
     */
    public function identify(string $distinctId, array $properties = []): void
    {
        if (!$this->enabled) {
            return;
        }

        try {
            Http::post("{$this->host}/capture/", [
                'api_key' => $this->apiKey,
                'event' => '$identify',
                'distinct_id' => $distinctId,
                'properties' => [
                    '$set' => $properties,
                ],
                'timestamp' => now()->toIso8601String(),
            ]);
        } catch (\Exception $e) {
            Log::warning('PostHog identify failed', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Helper: Capture event for current authenticated user.
     */
    public function captureForUser(string $event, array $properties = []): void
    {
        /** @var \App\Models\User|null $user */
        $user = auth()->user();
        if (!$user) {
            return;
        }

        $this->capture((string) $user->id, $event, $properties);
    }

    /**
     * Check if PostHog is enabled.
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
