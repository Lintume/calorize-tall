<?php

return [
    /**
     * Master switch for Helicone logging / proxying.
     */
    'enabled' => (bool) env('HELICONE_ENABLED', false),

    /**
     * Helicone API key (write access).
     *
     * Sent as: Helicone-Auth: Bearer <HELICONE_API_KEY>
     */
    'api_key' => env('HELICONE_API_KEY', ''),

    /**
     * OpenAI-compatible Helicone proxy base URL.
     *
     * For OpenAI proxying use: https://oai.helicone.ai/v1
     */
    'openai_proxy_url' => env('HELICONE_OPENAI_PROXY_URL', 'https://oai.helicone.ai/v1'),

    /**
     * Helicone Gateway base URL (OpenAI-compatible). Useful for proxying endpoints
     * that are not reliably supported by the OpenAI proxy (e.g. multipart uploads).
     *
     * For example: https://gateway.helicone.ai/v1
     */
    'gateway_url' => env('HELICONE_GATEWAY_URL', 'https://gateway.helicone.ai/v1'),

    /**
     * Whisper (multipart) proxying via Helicone Gateway is not always reliable.
     * When disabled, Whisper goes through the OpenAI proxy/base URL configured in Prism.
     */
    'whisper_use_gateway' => (bool) env('HELICONE_WHISPER_USE_GATEWAY', false),

    /**
     * Manual logger endpoint (JSON) - useful when proxying is not possible (e.g. multipart Whisper uploads).
     */
    'custom_log_url' => env('HELICONE_CUSTOM_LOG_URL', 'https://api.worker.helicone.ai/custom/v1/log'),

    /**
     * When enabled, we will send an additional Helicone manual-log record for Whisper calls.
     * This keeps Whisper working while still creating an entry in Helicone.
     */
    'whisper_manual_log' => (bool) env('HELICONE_WHISPER_MANUAL_LOG', true),
];


