<?php

namespace App\Services\DiaryAgent;

use Illuminate\Support\Facades\Log;

class DiaryAgentLogger
{
    private const REQUEST_ID_KEY = 'diaryAgentRequestId';

    public static function setRequestId(string $requestId): void
    {
        // Keep request id accessible to tool classes invoked later in the same request.
        app()->instance(self::REQUEST_ID_KEY, $requestId);
    }

    public static function requestId(): ?string
    {
        return app()->bound(self::REQUEST_ID_KEY) ? (string) app(self::REQUEST_ID_KEY) : null;
    }

    public static function enabled(): bool
    {
        return (bool) config('diary_agent.logging.enabled', false);
    }

    public static function payloadsEnabled(): bool
    {
        return (bool) config('diary_agent.logging.payloads', false);
    }

    public static function log(string $level, string $message, array $context = []): void
    {
        if (! self::enabled()) {
            return;
        }

        $context = array_merge([
            'requestId' => self::requestId(),
        ], $context);

        try {
            Log::channel('diary_agent')->log($level, $message, $context);
        } catch (\Throwable) {
            // Never break product flow because of logging issues.
            Log::log($level, $message, $context);
        }
    }

    public static function payload(mixed $value): mixed
    {
        if (! self::payloadsEnabled()) {
            return self::summarizeForLogs($value);
        }

        $truncate = (int) config('diary_agent.logging.truncate', 8000);

        if (is_string($value)) {
            return self::truncateString($value, $truncate);
        }

        if (is_array($value) || is_object($value)) {
            $json = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            if ($json === false) {
                return ['_unserializable' => true];
            }
            return self::truncateString($json, $truncate);
        }

        return $value;
    }

    private static function summarizeForLogs(mixed $value): array|string|null
    {
        if ($value === null) {
            return null;
        }

        if (is_string($value)) {
            return [
                '_type' => 'string',
                '_len' => mb_strlen($value),
                '_preview' => self::truncateString($value, 160),
            ];
        }

        if (is_array($value)) {
            return [
                '_type' => 'array',
                '_count' => count($value),
            ];
        }

        if (is_object($value)) {
            return [
                '_type' => 'object',
                '_class' => get_class($value),
            ];
        }

        return [
            '_type' => gettype($value),
        ];
    }

    private static function truncateString(string $text, int $max): string
    {
        if ($max <= 0) {
            return '';
        }
        if (mb_strlen($text) <= $max) {
            return $text;
        }
        return mb_substr($text, 0, $max) . '…[truncated]';
    }
}


