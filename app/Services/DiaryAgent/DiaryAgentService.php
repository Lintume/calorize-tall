<?php

namespace App\Services\DiaryAgent;

use App\Services\DiaryAgent\Tools\AddToFoodIntakeTool;
use App\Services\DiaryAgent\Tools\CreateProductTool;
use App\Services\DiaryAgent\Tools\DeleteFoodIntakeTool;
use App\Services\DiaryAgent\Tools\GetFoodIntakeTool;
use App\Services\DiaryAgent\Tools\SearchProductTool;
use App\Services\DiaryAgent\Tools\UpdateFoodIntakeTool;
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
        $systemPrompt = $this->buildSystemPrompt($context);

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

        $response = Prism::text()
            ->using(Provider::OpenAI, 'gpt-4o-mini')
            ->withSystemPrompt($systemPrompt)
            ->withMessages($messages)
            ->withTools($tools)
            ->withMaxSteps(10)
            ->asText();

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
    private function buildSystemPrompt(array $context): string
    {
        $date = $context['date'] ?? now()->toDateString();
        $activeMeal = $context['activeMeal'] ?? null;
        $locale = app()->getLocale();
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
            ? "The user currently has '{$activeMeal}' selected in their diary. Use this meal."
            : "No specific meal is selected. Based on current time ({$currentTime}), the likely meal is: {$suggestedMeal}. USE THIS MEAL BY DEFAULT without asking the user.";

        return <<<PROMPT
You are a helpful food diary assistant. You help users add, edit, and delete food items from their daily diary.

## Current Context
- Today's date: {$date}
- Current time: {$currentTime}
- User's language: {$locale}
- {$mealContext}

## CRITICAL: Meal Selection
- If user specifies a meal (breakfast, lunch, dinner, snack, сніданок, обід, вечеря, перекус) - use that meal
- If user does NOT specify a meal - AUTOMATICALLY use the suggested meal based on current time. DO NOT ASK the user which meal.
- Only ask for clarification if something is truly ambiguous (like which product they mean), NOT about the meal type.

## Your Capabilities
You can:
1. **Search for products** - Find existing products in the database
2. **Create products** - Add new products with estimated nutritional values
3. **Add to meals** - Add products to breakfast, lunch, dinner, or snack
4. **Edit portions** - Change the grams of existing items
5. **Delete items** - Remove items from meals
6. **Copy meals** - Copy items from one day/meal to another

## Language Support
Understand commands in English and Ukrainian:
- breakfast = сніданок
- lunch = обід  
- dinner = вечеря
- snack = перекус
- yesterday = вчора
- today = сьогодні
- tomorrow = завтра

## Default Portions (when user doesn't specify)
Use sensible defaults based on typical serving sizes:
- Apple, pear, orange: 150g
- Banana: 120g
- Egg: 60g (one egg)
- Bread slice: 30g
- Tea, coffee (cup): 250ml
- Milk (glass): 200ml
- Rice, pasta (cooked portion): 150g
- Chicken breast: 150g
- Candy, chocolate piece: 10-15g
- Rafaello, Ferrero: 10g per piece

## Date Handling
- "yesterday" / "вчора" = subtract 1 day from current date
- "today" / "сьогодні" = current date ({$date})
- "day before yesterday" / "позавчора" = subtract 2 days

## Important Rules
1. One tool per product: When adding multiple products, call searchProduct and addToFoodIntake for EACH product separately
2. Search before create: Always try searchProduct first. Only use createProduct if no matching product is found
3. Estimate nutrition: When creating products, estimate realistic nutritional values per 100g based on common food data
4. Respond in user's language: Reply in the same language the user used (Ukrainian or English)
5. Be concise: Keep responses short and actionable
6. Confirm actions: Summarize what you did/will do
7. NO MARKDOWN: Never use markdown formatting (no **, -, #, ` or other markup). Write plain text only.
8. NEVER ASK ABOUT MEAL TYPE: If user doesn't specify meal, use the suggested meal based on current time automatically
9. USE CONVERSATION HISTORY: Remember what user said in previous messages. If user refers to something from earlier in the conversation, use that context.
10. ACT IMMEDIATELY: When user provides products to add, add them immediately without asking unnecessary questions

## Response Format
After performing actions, provide a brief plain text summary like:
"Додав 150g курячої грудки та 250g чаю з цукром до перекусу ✓"

NEVER ask:
- "Which meal?" - use current time to determine
- "What product?" - if user already mentioned it in the conversation
PROMPT;
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
}

