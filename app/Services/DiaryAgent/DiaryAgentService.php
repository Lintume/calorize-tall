<?php

namespace App\Services\DiaryAgent;

use App\Services\DiaryAgent\Tools\AddToFoodIntakeTool;
use App\Services\DiaryAgent\Tools\CreateProductTool;
use App\Services\DiaryAgent\Tools\DeleteFoodIntakeTool;
use App\Services\DiaryAgent\Tools\GetFoodIntakeTool;
use App\Services\DiaryAgent\Tools\SearchProductTool;
use App\Services\DiaryAgent\Tools\UpdateFoodIntakeTool;
use App\Support\Helicone;
use App\Models\FoodIntake;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Facades\Tool;

class DiaryAgentService
{
    /**
     * Process a voice/text command and return agent response with actions
     */
    public function process(string $command, array $context): DiaryAgentResult
    {
        $requestId = (string) Str::uuid();

        $model = (string) config('diary_agent.model', 'gpt-4o-mini');
        $systemPrompt = $this->buildSystemPrompt($context, $command);

        $tools = [
            Tool::make(SearchProductTool::class),
            Tool::make(CreateProductTool::class),
            Tool::make(GetFoodIntakeTool::class),
            Tool::make(AddToFoodIntakeTool::class),
            Tool::make(UpdateFoodIntakeTool::class),
            Tool::make(DeleteFoodIntakeTool::class),
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
                ->using(Provider::OpenAI, $model)
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
            command: $command,
            date: $date,
            candidateDays: 7,
            frequencyDays: 30,
            maxCandidates: 5
        );

        return <<<PROMPT
You are a food diary agent that performs actions via tools.

Context:
Date: {$date}
Time: {$currentTime}
{$mealContext}

Global rules:
- Output plain text only (no markdown formatting). Be brief.
- Reply in the language used in the user's latest message (UA/EN), unless they ask otherwise.
- Use conversation history to resolve references (e.g. "як вчора", "те саме", "зроби як минулого разу").
- When the user provides items to add/edit/delete/copy, do it immediately via tools. Ask only if truly ambiguous (usually which product variant).

Meal selection:
- If the user names a meal (breakfast/lunch/dinner/snack or UA), use it.
- Otherwise use the selected/suggested meal from context. Do NOT ask “which meal?”.

RECENT DIARY MEMORY (only for ambiguity):
- Use it only for short generic messages (e.g. "кава", "йогурт", "тарілка борща").
- The user's message overrides memory.
- If the user adds qualifiers (e.g. "пісний", "без мʼяса", brand), do NOT pick a memory candidate unless its title clearly contains the same qualifier.
- If you choose a specific variant because of memory, mention it in the summary (e.g. "як і вчора/як минулого разу").
{$recentDiaryMemory}

Portions & quantities:
- Never represent quantity by adding the same product multiple times.
- If user says COUNT (e.g. "2 eggs"), add ONE item with grams = count * unit weight.
- If grams are missing, use defaults:
  Egg 60g each; Bread slice 30g; Apple/pear/orange 150g; Banana 120g; Tea/coffee 250ml; Milk 200ml; Candy 10-15g; Rafaello/Ferrero 10g each.

Dates:
- Interpret today/сьогодні as {$date}.
- Interpret yesterday/вчора as {$date} minus 1 day.
- Interpret day before yesterday/позавчора as {$date} minus 2 days.

Copying:
- If the user asks to copy, first call getFoodIntake for the source.
- Whole day copy: call getFoodIntake with mealType omitted or mealType="all".
- Re-add each returned item to the target date with the same mealType and grams.

Adding multiple different products:
- For each distinct product, call searchProduct then addToFoodIntake separately.

searchProduct usage:
- Never pass the raw user sentence as query. Use a short normalized product name (1-6 words).
- Prefer Ukrainian queries; if user wrote RU, translate food name to Ukrainian; fix common rusisms/typos (жарен*->смажен*, мука->борошно).
- Normalize diminutives and case endings to canonical product spelling before search (examples: "рафаелку/рафаелка" -> "рафаелло", "борща/борщу" -> "борщ").
- If multiple results have the same/near-identical title but very different nutrition, do NOT pick randomly or “first in list”. Prefer the nutritionally plausible variant for the food type; if still unsure, ask a short clarification. 
- If results are irrelevant, do NOT add them. Try up to 3 searches with improved queries.
- If still no clearly relevant match, createProduct (nutrition per 100g), then addToFoodIntake.

Create product:
- Estimate realistic nutrition per 100g.

After actions, output a short summary of what was done.
PROMPT;
    }

    /**
     * Build a compact "memory" from the user's recent diary entries.
     * The model should only use it to disambiguate short, generic messages.
     */
    private function buildRecentDiaryMemoryBlock(
        string $command,
        string $date,
        int $candidateDays = 7,
        int $frequencyDays = 30,
        int $maxCandidates = 5
    ): string {
        $userId = Auth::id();

        if (! $userId) {
            return "RECENT DIARY MEMORY: unavailable (user not authenticated)";
        }

        $tokens = $this->extractFocusTokens($command);

        // Even without tokens, keep memory short to avoid biasing the model.
        if (empty($tokens)) {
            return "RECENT DIARY MEMORY: (no focus tokens extracted from the message)";
        }

        $to = Carbon::parse($date)->toDateString();
        $toCarbon = Carbon::parse($date)->startOfDay();

        // 7-day candidates: recent matching entries, deduped by product_id, ordered by recency.
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
            $hay = mb_strtolower($title);

            if (! $this->containsAnyToken($hay, $tokens)) {
                continue;
            }

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

        // 30-day "most frequent matching variant"
        $fromFreq = Carbon::parse($date)->subDays($frequencyDays)->toDateString();
        $freq = FoodIntake::query()
            ->where('user_id', $userId)
            ->whereBetween('date', [$fromFreq, $to])
            ->with('product')
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->limit(1200)
            ->get();

        $freqAgg = [];
        foreach ($freq as $fi) {
            if (! $fi->product) {
                continue;
            }

            $pid = (int) $fi->product_id;
            $title = (string) $fi->product->title;
            $hay = mb_strtolower($title);

            if (! $this->containsAnyToken($hay, $tokens)) {
                continue;
            }

            if (! isset($freqAgg[$pid])) {
                $freqAgg[$pid] = [
                    'productId' => $pid,
                    'title' => $title,
                    'count' => 0,
                    'sumGrams' => 0,
                    'lastDate' => (string) $fi->date,
                    'lastRelative' => $this->relativeDayLabel($toCarbon, Carbon::parse((string) $fi->date)->startOfDay()),
                    'lastGrams' => (int) $fi->g,
                ];
            }

            $freqAgg[$pid]['count'] += 1;
            $freqAgg[$pid]['sumGrams'] += (int) $fi->g;
        }

        $mostFrequent = null;
        foreach ($freqAgg as $item) {
            if ($mostFrequent === null || $item['count'] > $mostFrequent['count']) {
                $mostFrequent = $item;
            }
        }

        $lines = [];
        $lines[] = "RECENT DIARY MEMORY (use only for ambiguity):";
        $lines[] = "Focus tokens: " . implode(", ", $tokens);
        $lines[] = "Matching candidates from last {$candidateDays} days (up to {$maxCandidates}):";

        if (empty($candidates)) {
            $lines[] = "(none)";
        } else {
            foreach ($candidates as $i => $c) {
                $typical = (int) round(($c['sumGrams'] ?? 0) / max(1, (int) ($c['count'] ?? 1)));
                $title = $this->sanitizeOneLine((string) $c['title']);
                $rel = $c['lastRelative'] ?? null;
                $relPart = $rel ? " ({$rel})" : "";
                $lines[] = ($i + 1) . ") productId={$c['productId']}; title=\"{$title}\"; last={$c['lastGrams']}g on {$c['lastDate']}{$relPart}; typical={$typical}g; times={$c['count']}";
            }
        }

        $lines[] = "Most frequent matching variant from last {$frequencyDays} days:";
        if ($mostFrequent === null) {
            $lines[] = "(none)";
        } else {
            $typical = (int) round(($mostFrequent['sumGrams'] ?? 0) / max(1, (int) ($mostFrequent['count'] ?? 1)));
            $title = $this->sanitizeOneLine((string) $mostFrequent['title']);
            $rel = $mostFrequent['lastRelative'] ?? null;
            $relPart = $rel ? " ({$rel})" : "";
            $lines[] = "productId={$mostFrequent['productId']}; title=\"{$title}\"; times={$mostFrequent['count']}; typical={$typical}g; last={$mostFrequent['lastGrams']}g on {$mostFrequent['lastDate']}{$relPart}";
        }

        return implode("\n", $lines);
    }

    private function extractFocusTokens(string $text): array
    {
        $t = mb_strtolower($text);
        $t = preg_replace('/[0-9]+/u', ' ', $t);
        $t = preg_replace('/[^\p{L}\s]+/u', ' ', $t);
        $parts = preg_split('/\s+/u', trim($t)) ?: [];

        $stop = [
            'і','й','та','на','у','в','з','із','зі','до','по','за','для','без',
            'це','цей','ця','ці','той','такий','я','ти','він','вона','вони','ми','ви',
            'a','an','the','and','or','to','of','in','on','for','with','without',
            'додай','додати','запиши','внеси','добав','постав','хочу','будь','ласка',
            'тарілка','чашка','склянка','порція','шматок','ложка','ложки','шт','штуки',
            'г','гр','грам','грами','ml','мл',
        ];

        $tokens = [];
        foreach ($parts as $p) {
            if ($p === '' || mb_strlen($p) < 3) {
                continue;
            }
            if (in_array($p, $stop, true)) {
                continue;
            }
            foreach ($this->tokenVariants($p) as $v) {
                if ($v === '' || mb_strlen($v) < 3) {
                    continue;
                }
                if (in_array($v, $stop, true)) {
                    continue;
                }
                $tokens[] = $v;
            }
        }

        return array_values(array_unique($tokens));
    }

    /**
     * Generate a few variants for better matching across common UA/RU case endings.
     * Goal: improve substring matching (e.g. "борща/борщу/борщем" -> "борщ").
     */
    private function tokenVariants(string $token): array
    {
        $token = trim(mb_strtolower($token));

        // Normalize apostrophes (optional but helps UA words like "п'ять")
        $token = str_replace(["’", "ʼ", "`"], "'", $token);

        $variants = [$token];

        // Also try without apostrophe (often product titles omit it)
        if (str_contains($token, "'")) {
            $variants[] = str_replace("'", '', $token);
        }

        $stem = $this->stemCyrillicToken($token);
        if ($stem !== null) {
            $variants[] = $stem;
        }

        // One more pass: if we removed apostrophe, stem that too
        if (isset($variants[1]) && is_string($variants[1])) {
            $stem2 = $this->stemCyrillicToken($variants[1]);
            if ($stem2 !== null) {
                $variants[] = $stem2;
            }
        }

        // Unique, keep order
        $out = [];
        foreach ($variants as $v) {
            if ($v === '' || in_array($v, $out, true)) {
                continue;
            }
            $out[] = $v;
        }

        return $out;
    }

    /**
     * Conservative stemmer for UA/RU: strips common inflectional endings.
     * Returns null if no safe stemming applied.
     */
    private function stemCyrillicToken(string $token): ?string
    {
        $token = trim($token);
        $len = mb_strlen($token);

        // Too short -> don't touch
        if ($len < 4) {
            return null;
        }

        // Only attempt stemming for Cyrillic-ish words (UA/RU)
        if (! preg_match('/\p{Cyrillic}/u', $token)) {
            return null;
        }

        // Common case endings UA/RU (sorted by length desc)
        $suffixes = [
            'ями', 'ами',
            'ові', 'еві',
            'ому', 'ему',
            'ого', 'его',
            'ими',
            'ях', 'ах',
            'ів', 'їв', 'ев', 'ов', 'ей',
            'ою', 'ею', 'єю',
            'ом', 'ем',
            'ої', 'єї',
            'ий', 'ій',
            'у', 'ю', 'а', 'я', 'і', 'ї', 'и', 'е',
        ];

        foreach ($suffixes as $suf) {
            $sufLen = mb_strlen($suf);
            if ($sufLen >= $len) {
                continue;
            }
            if (! str_ends_with($token, $suf)) {
                continue;
            }

            $stem = mb_substr($token, 0, $len - $sufLen);

            // Keep stems useful for substring matching
            if (mb_strlen($stem) < 3) {
                return null;
            }

            return $stem;
        }

        return null;
    }

    private function containsAnyToken(string $haystackLower, array $tokens): bool
    {
        foreach ($tokens as $t) {
            if ($t !== '' && mb_strpos($haystackLower, $t) !== false) {
                return true;
            }
        }
        return false;
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

    // Helicone now captures the full prompt/messages/tool calls/response for every LLM request.
}

