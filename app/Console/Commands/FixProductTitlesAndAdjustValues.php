<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class FixProductTitlesAndAdjustValues extends Command
{
    protected $signature = 'products:fix-titles-and-adjust';

    protected $description = 'Fix product titles and adjust nutritional values.';

    public function handle()
    {
        $openAi = \OpenAI::client(env('OPENAI_API_KEY'));

        $batchSize = 50; // Number of products to process at once
        Product::chunk($batchSize, function ($products) use ($openAi) {
            $titles = $products->pluck('title')->toArray();
            $this->info('Processing IDs: ' . $products->first()->id . ' - ' . $products->last()->id);

            $response = $openAi->chat()->create([
                'model' => 'gpt-4o',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Here is the array of titles of different food products. You are a multilingual spelling and grammar assistant. Your task is to:
- Identify the language of each product title. if you see the cyrillic alphabet word, it is Ukrainian language.
- Correct spelling or grammar errors.
- Do not alter brand names, numerical values, or percentages (e.g., "4%" or "Carling").
- If a title is already correct, leave it unchanged.
- If you are unsure about a correction - skip it, correct only very obvious mistakes.
- Replace Russian-origin words with their correct Ukrainian counterparts. Example: \'Напиток\' -> \'Напій\', \'Масло сливочное\' -> \'Вершкове масло\'.

Return the corrected array of titles. Be sure that the number of titles and order of titles in the array remain the same.

Examples of valid corrections:
- "Пиво 4% свіле Карлінг" -> "Пиво 4% світле Карлінг" (fix grammar in Ukrainian).
- "Beer 4% lite Carling" -> "Beer 4% light Carling" (fix grammar in English).
- "Ser żółty" -> "Ser żółty" (leave Polish unchanged if no errors).
- "Сир жовтий" -> "Сир жовтий" (leave Ukrainian unchanged if no errors).
- "Висіки вівсяні" -> "Висівки вівсяні" (fix spelling in Ukrainian).
- "Пиво 3 об.  Правда" -> "Пиво 3% об. Правда" (fix grammar in Ukrainian, remove extra space).
- "Пиво 3% об. правда" -> "Пиво 3% об. Правда" (fix grammar in Ukrainian, capitalize the first letter of the proper noun).
',
                    ],
                    [
                        'role' => 'user',
                        'content' => json_encode($titles),
                    ],
                ],
            ]);

            $fixedTitles = json_decode($response['choices'][0]['message']['content'], true);

            foreach ($products as $index => $product) {
                $originalTitle = $product->title;

                if (!empty($fixedTitles[$index]) && $fixedTitles[$index] !== $product->title) {
                    $product->title = $fixedTitles[$index];
                    $this->info("Updated title for product ID {$product->id}: '{$originalTitle}' -> '{$product->title}'");
                }

                // Adjust nutritional values
                if ($product->proteins > 0) {
                    $product->proteins += $this->getRandomAdjustment();
                }

                if ($product->fats > 0) {
                    $product->fats += $this->getRandomAdjustment();
                }

                if ($product->carbohydrates > 0) {
                    $product->carbohydrates += $this->getRandomAdjustment();
                }

                if ($product->calories > 0) {
                    $product->calories += $this->getRandomAdjustment();
                }

                $product->save();
            }
        });

        $this->info('Product titles and nutritional values have been updated.');
    }

    private function getRandomAdjustment(): float
    {
        return round(mt_rand(1, 7) / 10, 1); // Random value between 0.1 and 0.7
    }
}
