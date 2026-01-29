<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PostHog Configuration
    |--------------------------------------------------------------------------
    |
    | Configure PostHog analytics for tracking user behavior and events.
    |
    */

    // Disabled by default in local environment
    'enabled' => env('POSTHOG_ENABLED', env('APP_ENV') === 'production'),

    'api_key' => env('POSTHOG_API_KEY'),

    'host' => env('POSTHOG_HOST', 'https://eu.i.posthog.com'),

    /*
    |--------------------------------------------------------------------------
    | Personal Data Capture
    |--------------------------------------------------------------------------
    |
    | Whether to include personal data (email, name) when identifying users.
    | Set to false in environments where you want to minimize PII exposure.
    |
    */

    'capture_personal_data' => env('POSTHOG_CAPTURE_PERSONAL_DATA', true),
];
