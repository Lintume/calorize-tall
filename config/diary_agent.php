<?php

return [
    'logging' => [
        // Master switch
        'enabled' => env('DIARY_AGENT_LOG_ENABLED', false),

        // If true, logs full prompts/messages/model response text/tool args.
        // WARNING: may contain sensitive user data.
        'payloads' => env('DIARY_AGENT_LOG_PAYLOADS', false),

        // Truncate long strings in logs to avoid huge log files.
        'truncate' => (int) env('DIARY_AGENT_LOG_TRUNCATE', 8000),
    ],
];


