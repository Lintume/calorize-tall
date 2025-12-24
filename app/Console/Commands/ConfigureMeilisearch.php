<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Meilisearch\Client;

class ConfigureMeilisearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meilisearch:configure {--fresh : Drop and recreate the index}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configure Meilisearch index settings including synonyms for transliteration';

    /**
     * Common food product synonyms (Ukrainian ↔ Latin transliteration).
     */
    private const SYNONYMS = [
        // Popular brands and products
        'rafaello' => ['рафаелло', 'рафаело', 'raffaello'],
        'nutella' => ['нутелла', 'нутела', 'нутела'],
        'coca-cola' => ['кока-кола', 'кока кола', 'coca cola', 'cocacola'],
        'pepsi' => ['пепсі', 'пепси'],
        'snickers' => ['снікерс', 'сникерс'],
        'mars' => ['марс'],
        'twix' => ['твікс', 'твикс'],
        'milka' => ['мілка', 'милка'],
        'oreo' => ['орео'],
        'kitkat' => ['кіткат', 'киткат', 'kit-kat', 'kit kat'],
        'bounty' => ['баунті', 'баунти'],
        'nestle' => ['нестле', 'несле'],
        'danone' => ['данон', 'даноне'],
        'activia' => ['активіа', 'активия'],
        'yakult' => ['якульт'],

        // Common foods
        'banana' => ['банан', 'банани'],
        'apple' => ['яблуко', 'яблука'],
        'orange' => ['апельсин', 'апельсини'],
        'milk' => ['молоко'],
        'bread' => ['хліб', 'хлеб'],
        'cheese' => ['сир', 'сыр'],
        'butter' => ['масло'],
        'egg' => ['яйце', 'яйця', 'яйцо'],
        'chicken' => ['курка', 'курица', 'куриця'],
        'beef' => ['яловичина', 'говядина'],
        'pork' => ['свинина'],
        'fish' => ['риба', 'рыба'],
        'salmon' => ['лосось', 'семга', 'сьомга'],
        'rice' => ['рис'],
        'pasta' => ['паста', 'макарони', 'макароны'],
        'potato' => ['картопля', 'картофель', 'картошка'],
        'tomato' => ['помідор', 'томат', 'помидор'],
        'cucumber' => ['огірок', 'огурец'],
        'carrot' => ['морква', 'морковь', 'морковка'],
        'onion' => ['цибуля', 'лук'],
        'garlic' => ['часник', 'чеснок'],
        'sugar' => ['цукор', 'сахар'],
        'salt' => ['сіль', 'соль'],
        'coffee' => ['кава', 'кофе'],
        'tea' => ['чай'],
        'water' => ['вода'],
        'juice' => ['сік', 'сок'],
        'yogurt' => ['йогурт'],
        'kefir' => ['кефір', 'кефир'],
        'sour cream' => ['сметана'],
        'cottage cheese' => ['творог', 'сирок'],

        // Grains and cereals
        'oatmeal' => ['вівсянка', 'овсянка', 'вівсяна каша'],
        'buckwheat' => ['гречка', 'гречана каша'],
        'millet' => ['пшоно', 'пшенка'],

        // Nuts
        'almond' => ['мигдаль', 'миндаль'],
        'walnut' => ['волоський горіх', 'грецкий орех', 'горіх'],
        'peanut' => ['арахіс', 'арахис'],
        'cashew' => ['кеш\'ю', 'кешью'],
        'hazelnut' => ['фундук', 'лісовий горіх'],

        // Fast food
        'mcdonalds' => ['макдональдс', 'макдак', 'mcdonald\'s'],
        'burger' => ['бургер', 'гамбургер'],
        'pizza' => ['піца', 'пицца'],
        'shawarma' => ['шаурма', 'шаверма'],
        'sushi' => ['суші', 'суши'],
    ];

    public function handle(): int
    {
        $client = new Client(
            config('scout.meilisearch.host'),
            config('scout.meilisearch.key')
        );

        $indexName = (new \App\Models\Product)->searchableAs();

        $this->info("Configuring Meilisearch index: {$indexName}");

        // Drop index if --fresh flag is set
        if ($this->option('fresh')) {
            $this->warn('Dropping existing index...');
            try {
                $client->deleteIndex($indexName);
                $this->info('Index dropped successfully.');
            } catch (\Exception $e) {
                $this->warn('Index does not exist or could not be deleted.');
            }
        }

        // Create or get index
        try {
            $client->createIndex($indexName, ['primaryKey' => 'id']);
            $this->info('Index created.');
        } catch (\Exception $e) {
            $this->info('Index already exists.');
        }

        $index = $client->index($indexName);

        // Configure settings from config
        $settings = config('scout.meilisearch.index-settings.products', []);
        if (! empty($settings)) {
            $this->info('Applying index settings from config...');
            $task = $index->updateSettings($settings);
            $this->waitForTask($client, $task);
        }

        // Configure synonyms for transliteration
        $this->info('Configuring synonyms for transliteration...');
        $synonyms = $this->buildSynonymsMap();
        $task = $index->updateSynonyms($synonyms);
        $this->waitForTask($client, $task);

        $this->info('✓ Meilisearch configured successfully!');
        $this->newLine();
        $this->info('Next steps:');
        $this->line('  1. Import products: php artisan scout:import "App\\Models\\Product"');
        $this->line('  2. Test search in your application');

        return Command::SUCCESS;
    }

    /**
     * Build synonyms map where all variations point to each other.
     */
    private function buildSynonymsMap(): array
    {
        $synonymsMap = [];

        foreach (self::SYNONYMS as $main => $alternatives) {
            $allVariants = array_merge([$main], $alternatives);

            // Each word should map to all other variants
            foreach ($allVariants as $word) {
                $otherVariants = array_values(array_filter($allVariants, fn ($v) => $v !== $word));
                if (! empty($otherVariants)) {
                    $synonymsMap[$word] = $otherVariants;
                }
            }
        }

        return $synonymsMap;
    }

    /**
     * Wait for Meilisearch task to complete.
     */
    private function waitForTask(Client $client, array $task): void
    {
        $client->waitForTask($task['taskUid'], 10000);
    }
}

