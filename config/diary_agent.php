<?php

return [
    // Model used by the Diary agent (Prism/OpenAI by default).
    // You can override per-environment via DIARY_AGENT_MODEL (e.g. "gpt-4o", "gpt-4o-mini", "gemini-3.0-pro").
    // The provider (OpenAI/Gemini) is automatically determined based on the model name.
    'model' => env('DIARY_AGENT_MODEL', 'gpt-4o-mini'),
];


