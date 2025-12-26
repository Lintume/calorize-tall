<?php

namespace App\Services\DiaryAgent;

use Illuminate\Support\Facades\Log;

class DiaryAgentLogger
{
    private const REQUEST_ID_KEY = 'diaryAgentRequestId';
    private const MAX_LOG_ITEMS = 50;
    private const MAX_LOG_DEPTH = 6;

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

        // Keep structure (arrays/objects) in logs to make payloads readable/searchable.
        // Only truncate strings and cap depth/size to avoid huge log entries.
        return self::truncateDeep($value, $truncate, 0);
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

    private static function truncateDeep(mixed $value, int $truncate, int $depth): mixed
    {
        if ($value === null) {
            return null;
        }

        if ($depth >= self::MAX_LOG_DEPTH) {
            return self::summarizeForLogs($value);
        }

        if (is_string($value)) {
            return self::truncateString($value, $truncate);
        }

        if (is_bool($value) || is_int($value) || is_float($value)) {
            return $value;
        }

        if (is_array($value)) {
            $out = [];
            $i = 0;
            foreach ($value as $k => $v) {
                if ($i >= self::MAX_LOG_ITEMS) {
                    $out['_truncated'] = true;
                    $out['_total_items'] = count($value);
                    break;
                }
                $out[$k] = self::truncateDeep($v, $truncate, $depth + 1);
                $i++;
            }
            return $out;
        }

        if (is_object($value)) {
            // Try common serialization patterns first.
            if ($value instanceof \JsonSerializable) {
                return self::truncateDeep($value->jsonSerialize(), $truncate, $depth + 1);
            }
            if (method_exists($value, 'toArray')) {
                try {
                    return self::truncateDeep($value->toArray(), $truncate, $depth + 1);
                } catch (\Throwable) {
                    // fall through
                }
            }

            // As a last resort, attempt to log public properties.
            $vars = get_object_vars($value);
            if (! empty($vars)) {
                return self::truncateDeep($vars, $truncate, $depth + 1);
            }

            return self::summarizeForLogs($value);
        }

        return self::summarizeForLogs($value);
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


