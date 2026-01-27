<?php

namespace App\Services\DiaryAgent;

use App\Services\DiaryAgent\Tools\AddMeasurementTool;
use App\Services\DiaryAgent\Tools\AddToFoodIntakeTool;
use App\Services\DiaryAgent\Tools\CreateProductTool;
use App\Services\DiaryAgent\Tools\DeleteFoodIntakeTool;
use App\Services\DiaryAgent\Tools\GetFoodIntakeTool;
use App\Services\DiaryAgent\Tools\SearchProductTool;
use App\Services\DiaryAgent\Tools\UpdateFoodIntakeTool;
use App\Services\Prism\GeminiWithHelicone;
use App\Support\Helicone;
use App\Models\FoodIntake;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache as LaravelCache;
use Illuminate\Support\Str;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Facades\Tool;

class DiaryAgentService
{
    /**
     * Cache key for the static system prompt
     */
    private const STATIC_PROMPT_CACHE_KEY = 'diary_agent:static_prompt_cache';

    /**
     * Process a voice/text command and return agent response with actions
     */
    public function process(string $command, array $context): DiaryAgentResult
    {
        $requestId = (string) Str::uuid();

        $model = (string) config('diary_agent.model', 'gpt-4o-mini');
        
        // Determine provider based on model name
        $provider = $this->determineProvider($model);
        
        // Build system prompt (optimized for implicit caching: static first, dynamic last)
        $systemPrompt = $this->buildSystemPrompt($context, $command);
        
        // For Gemini models, ensure static prompt is cached (implicit caching works automatically
        // when static content comes first, which we've already done in buildSystemPrompt)

        $tools = [
            Tool::make(SearchProductTool::class),
            Tool::make(CreateProductTool::class),
            Tool::make(GetFoodIntakeTool::class),
            Tool::make(AddToFoodIntakeTool::class),
            Tool::make(UpdateFoodIntakeTool::class),
            Tool::make(DeleteFoodIntakeTool::class),
            Tool::make(AddMeasurementTool::class),
        ];

        // Build messages array with conversation history
        $messages = $this->buildMessages($context['messages'] ?? [], $command);

        try {
            $heliconeHeaders = Helicone::headers(
                sessionId: $requestId,
                sessionPath: 'diary_agent/process',
                properties: Helicone::defaultProperties([
                    'Feature' => 'diary_agent',
                    'Locale' => app()->getLocale(),
                    'Date' => $context['date'] ?? null,
                    'ActiveMeal' => $context['activeMeal'] ?? null,
                    'RequestId' => $requestId,
                ]),
                sessionProperties: [
                    'feature' => 'diary_agent',
                    'userId' => Auth::id(),
                    'date' => $context['date'] ?? null,
                    'activeMeal' => $context['activeMeal'] ?? null,
                    'locale' => app()->getLocale(),
                ],
            );

            $response = Prism::text()
                ->using($provider, $model)
                ->withSystemPrompt($systemPrompt)
                ->withMessages($messages)
                ->withTools($tools)
                ->withMaxSteps(10)
                ->withClientOptions([
                    'headers' => $heliconeHeaders,
                ])
                ->asText();
        } catch (\Throwable $e) {
            throw $e;
        }

        // Parse the response and extract actions performed
        $actions = $this->parseToolCalls($response);

        return new DiaryAgentResult(
            message: $response->text,
            actions: $actions,
            success: true
        );
    }

    /**
     * Build messages array from conversation history
     */
    private function buildMessages(array $history, string $currentMessage): array
    {
        $messages = [];

        // Add previous messages from history
        foreach ($history as $msg) {
            if ($msg['role'] === 'user') {
                $messages[] = new \Prism\Prism\ValueObjects\Messages\UserMessage($msg['content']);
            } elseif ($msg['role'] === 'assistant') {
                $messages[] = new \Prism\Prism\ValueObjects\Messages\AssistantMessage($msg['content']);
            }
        }

        // Add current user message
        $messages[] = new \Prism\Prism\ValueObjects\Messages\UserMessage($currentMessage);

        return $messages;
    }

    /**
     * Build the system prompt with context
     */
    private function buildSystemPrompt(array $context, string $command): string
    {
        $date = $context['date'] ?? now()->toDateString();
        $activeMeal = $context['activeMeal'] ?? null;
        $currentTime = now()->format('H:i');
        $currentHour = (int) now()->format('H');

        // Determine suggested meal based on time
        $suggestedMeal = match (true) {
            $currentHour >= 6 && $currentHour < 11 => 'breakfast (сніданок)',
            $currentHour >= 11 && $currentHour < 15 => 'lunch (обід)',
            $currentHour >= 15 && $currentHour < 19 => 'snack (перекус)',
            $currentHour >= 19 && $currentHour < 23 => 'dinner (вечеря)',
            default => 'snack (перекус)',
        };

        $mealContext = $activeMeal
            ? "The user currently has '{$activeMeal}' selected in their diary. Use this meal if user not specified otherwise."
            : "No specific meal is selected. Based on current time ({$currentTime}), the likely meal is: {$suggestedMeal}. USE THIS MEAL BY DEFAULT without asking the user if user not specified otherwise.";

        $recentDiaryMemory = $this->buildRecentDiaryMemoryBlock(
            date: $date,
            candidateDays: 7,
            maxCandidates: 15
        );

        // Split prompt: static rules first (for implicit caching), dynamic context last
        $staticRules = <<<STATIC
Food diary agent for calculating calories and macros. Use tools to add/edit/delete/copy items.
Also can record body measurements (weight, chest, waist, thighs, wrist, neck, biceps, mood, hunger, sleep).

Rules:
- Plain text only, brief replies. Match user language (UA/EN).
- Use history for references ("як вчора", "те саме").
- Act immediately; ask only if truly ambiguous.
- Meal: use user's name or context default. Don't ask "which meal?".
- Measurements: use addMeasurement to log weight and body metrics. At least one param required (kg, chest, waist, thighs, wrist, neck, biceps, mood, hunger, sleep).

Quantities:
- Never add same product multiple times. Count items: "2 eggs" = 120g (one entry).
- Prioritize the cooking method (fried, boiled, etc.). If the found products do not specify the cooking method or the BV contradicts logic (for example, 0g fat for fried), be sure to use createProduct to create the exact variant.
- Defaults: egg 60g, bread 30g, apple/pear/orange 150g, banana 120g, tea/coffee 250ml, milk 200ml, candy 10-15g, Rafaello/Ferrero 10g.

Copying: getFoodIntake(source), then re-add each item to target date/meal.

Search:
- Database: Meilisearch with ~86,000 products (local Ukrainian dishes and supermarket products, all in Ukraine).
- Normalize query (1-6 words). UA preferred; fix rusisms (жарен*->смажен*, мука->борошно).
- Normalize endings: "рафаелку"->"рафаелло", "борща"->"борщ".
- If ambiguous nutrition, prefer plausible variant or ask briefly.
- Max 3 search attempts. If no match, createProduct then addToFoodIntake.

After actions, output brief summary. IMPORTANT: If you created a new product using createProduct (not just found it via searchProduct), explicitly mention this in the summary. For example: "Створив новий продукт 'риба біла смажена в борошні' та додав 100г на обід" or "Created new product 'fried fish in flour' and added 100g to lunch". This helps users understand when new products are being added to their database.
STATIC;

        // Dynamic context goes last (not cached)
        $memorySection = $recentDiaryMemory ? "\n{$recentDiaryMemory}\n" : "";
        $dynamicContext = <<<DYNAMIC

Context: {$date} {$currentTime}. {$mealContext}
Dates: today={$date}, yesterday={$date}-1d, позавчора={$date}-2d.{$memorySection}
DYNAMIC;

        return $staticRules . $dynamicContext;
    }

    /**
     * Build a compact "memory" from the user's recent diary entries.
     * Sends all recent entries without word filtering (more effective for UA language).
     */
    private function buildRecentDiaryMemoryBlock(
        string $date,
        int $candidateDays = 7,
        int $maxCandidates = 15
    ): string {
        $userId = Auth::id();

        if (! $userId) {
            return "";
        }

        $to = Carbon::parse($date)->toDateString();
        $toCarbon = Carbon::parse($date)->startOfDay();

        // 7-day entries: all recent entries, deduped by product_id, ordered by recency.
        $fromCandidates = Carbon::parse($date)->subDays($candidateDays)->toDateString();
        $recent = FoodIntake::query()
            ->where('user_id', $userId)
            ->whereBetween('date', [$fromCandidates, $to])
            ->with('product')
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->limit(300)
            ->get();

        $candidateAgg = [];
        $candidateOrder = [];

        foreach ($recent as $fi) {
            if (! $fi->product) {
                continue;
            }

            $pid = (int) $fi->product_id;
            $title = (string) $fi->product->title;

            if (! isset($candidateAgg[$pid])) {
                // Don't introduce new candidates once we reached the cap,
                // but keep aggregating already-selected candidates.
                if (count($candidateOrder) >= $maxCandidates) {
                    continue;
                }
                $candidateAgg[$pid] = [
                    'productId' => $pid,
                    'title' => $title,
                    'lastDate' => (string) $fi->date,
                    'lastRelative' => $this->relativeDayLabel($toCarbon, Carbon::parse((string) $fi->date)->startOfDay()),
                    'lastGrams' => (int) $fi->g,
                    'sumGrams' => 0,
                    'count' => 0,
                ];
                $candidateOrder[] = $pid;
            }

            $candidateAgg[$pid]['sumGrams'] += (int) $fi->g;
            $candidateAgg[$pid]['count'] += 1;
        }

        $candidates = [];
        foreach ($candidateOrder as $pid) {
            if (! isset($candidateAgg[$pid])) {
                continue;
            }
            $candidates[] = $candidateAgg[$pid];
            if (count($candidates) >= $maxCandidates) {
                break;
            }
        }

        // Skip memory section entirely if no data found
        if (empty($candidates)) {
            return "";
        }

        $lines = [];
        $lines[] = "RECENT DIARY (last {$candidateDays}d, for disambiguation):";

        foreach ($candidates as $c) {
            $typical = (int) round(($c['sumGrams'] ?? 0) / max(1, (int) ($c['count'] ?? 1)));
            $title = $this->sanitizeOneLine((string) $c['title']);
            $rel = $c['lastRelative'] ?? null;
            $relPart = $rel ? " ({$rel})" : "";
            $lines[] = "- id={$c['productId']} \"{$title}\" {$c['lastGrams']}g{$relPart}, avg {$typical}g, {$c['count']}x";
        }

        return implode("\n", $lines);
    }

    private function sanitizeOneLine(string $text): string
    {
        $text = str_replace(["\r", "\n"], ' ', $text);
        $text = preg_replace('/\s+/u', ' ', $text);
        return trim($text);
    }

    private function relativeDayLabel(Carbon $contextDate, Carbon $entryDate): ?string
    {
        // Positive diff means entry is in the past relative to context date.
        $diff = $entryDate->diffInDays($contextDate, false);
        if ($diff === 0) {
            return 'today/сьогодні';
        }
        if ($diff === 1) {
            return 'yesterday/вчора';
        }
        if ($diff === 2) {
            return 'day before yesterday/позавчора';
        }
        if ($diff > 2) {
            return "{$diff} days ago";
        }
        return null;
    }

    /**
     * Parse tool calls from the response to extract actions
     */
    private function parseToolCalls($response): array
    {
        $actions = [];

        // Get the steps from the response
        if (property_exists($response, 'steps')) {
            foreach ($response->steps as $step) {
                if (isset($step->toolCalls)) {
                    foreach ($step->toolCalls as $toolCall) {
                        $actions[] = [
                            'tool' => $toolCall->name,
                            'arguments' => method_exists($toolCall, 'arguments')
                                ? $toolCall->arguments()
                                : [],
                            'result' => $toolCall->result ?? null,
                        ];
                    }
                }
            }
        }

        return $actions;
    }

    /**
     * Determine the provider based on model name
     */
    private function determineProvider(string $model): Provider
    {
        // Check if model is a Gemini model
        if (str_starts_with(strtolower($model), 'gemini-')) {
            return Provider::Gemini;
        }

        // Default to OpenAI for GPT models and others
        return Provider::OpenAI;
    }

    // Helicone now captures the full prompt/messages/tool calls/response for every LLM request.
}
