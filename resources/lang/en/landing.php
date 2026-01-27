<?php

return [
    'meta' => [
        'title' => 'Calorize — an AI food diary for Ukraine',
        'description' => 'A calorie tracker made for Ukraine where AI actually does the work: write naturally — Calorize picks the right variant from the database, remembers your habits, and logs calories & macros.',
        'keywords' => 'calorie tracker, food diary, macro tracker, calorie counting, Ukraine, Ukrainian food database, recipes, AI assistant',
    ],

    'hero' => [
        'eyebrow' => 'Made for Ukraine',
        'title' => 'Calories & macros — in one message.',
        'subtitle' => 'No tap marathons. Write like you talk — Calorize finds the right product, remembers your usual variants, and logs everything into your diary.',
        'cta_primary_guest' => 'Start free',
        'cta_primary_auth' => 'Open diary',
        'cta_secondary' => 'Log in',
        'note' => 'Free while the product is actively evolving.',
    ],

    'proof' => [
        'foods' => '≈86k foods (UA)',
        'voice' => 'voice or text input',
        'memory' => 'smart variant memory',
        'recipes' => 'recipes that match real life',
    ],

    'demo' => [
        'title' => 'Logging without the tap marathon.',
        'subtitle' => 'One message — and it’s in your diary.',
        'micro_1' => '"a bowl of borscht"',
        'micro_2' => '"copy yesterday to today"',
        'micro_3' => '"delete all entries today"',
        'memory_line' => 'I remember: lately you usually pick “home borscht”.',
        'assistant_reply' => 'Added “home borscht” 350g to lunch. 215 kcal · P 9 · F 7 · C 28.',
        'assistant_reply_2' => 'Want a different variant? Say “lean / with meat / fried”.',
    ],

    'mock' => [
        'today' => 'Today',
        'in_budget' => 'in budget',
        'lunch' => 'Lunch',
        'memory' => 'Memory',
        'ai' => 'AI',
    ],

    'ai_can' => [
        'title' => 'What AI can do',
        'subtitle' => 'Not “chat for show”. It actually performs actions in your diary.',
        'items' => [
            [
                'title' => 'Understands natural phrasing',
                'example' => '"440g homemade soup with dumplings…"',
            ],
            [
                'title' => 'Copies days & meals',
                'example' => '"copy yesterday’s breakfast to today"',
            ],
            [
                'title' => 'Bulk actions',
                'example' => '"delete all entries today"',
            ],
            [
                'title' => 'Multiple foods in one message',
                'example' => '"add 100g fish + 70g pineapple & shrimp skewers"',
            ],
            [
                'title' => 'Memory for “my borscht”',
                'example' => '"add borscht" or "add Rafaello" — it picks your usual variant',
            ],
        ],
    ],

    'sections' => [
        'why_title' => 'Why it works in real life',
        'why_items' => [
            [
                'title' => 'Less work, more clarity',
                'text' => 'You don’t “fill forms” — you just log food. Calorize picks the meal, suggests typical portions, and lets you fix things in one sentence.',
            ],
            [
                'title' => 'AI that actually acts',
                'text' => 'Add, edit, delete, copy meals — straight from chat. Short messages work. It only asks when ambiguity really matters.',
            ],
            [
                'title' => 'Recipes with real accuracy',
                'text' => 'Calculated by the final cooked weight: evaporation/moisture loss is accounted for automatically — no “cooking coefficients”.',
            ],
        ],

        'free_title' => 'Free for now',
        'free_text' => 'Calorize is actively evolving, so access is open. No plans, no pricing tricks — just use it.',

        'geek_title' => 'Under the hood (for the curious)',
        'geek_items' => [
            [
                'title' => 'Vector search + Meilisearch',
                'text' => 'Finds “the same thing” even if you type naturally or with small mistakes.',
            ],
            [
                'title' => 'Laravel',
                'text' => 'A solid foundation and clean architecture for speed and reliability.',
            ],
            [
                'title' => 'Gemini + Whisper',
                'text' => 'An action-taking diary agent plus voice recognition — not “chat for chat’s sake”.',
            ],
        ],
    ],

    'cta' => [
        'title' => 'Track food — not UI.',
        'subtitle' => 'A few messages a day — and you actually know your calories & macros.',
        'button_guest' => 'Create account',
        'button_auth' => 'Go to diary',
    ],

    'blog' => [
        'eyebrow' => 'Science of weight',
        'title' => 'Why diets fail — and what to do instead',
        'subtitle' => 'No scare tactics, no moralism. We explain biology — so you understand what\'s happening in your body.',
        'view_all' => 'All articles',
        'cta_title' => 'Want more?',
        'cta_text' => 'Our blog has 12 research-backed articles. On appetite, metabolism, hormones, and fitness myths.',
        'cta_button' => 'Read the blog',
    ],
];

