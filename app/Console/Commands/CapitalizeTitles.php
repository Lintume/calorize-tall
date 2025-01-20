<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CapitalizeTitles extends Command
{
    protected $signature = 'products:capitalize-titles';

    protected $description = 'Capitalize the first letter of each product title.';

    public function handle()
    {
        $batchSize = 50; // Number of products to process at once
        Product::chunk($batchSize, function ($products) {
            $this->info('Processing IDs: ' . $products->first()->id . ' - ' . $products->last()->id);

            foreach ($products as $product) {
                $originalTitle = $product->title;
                $capitalizedTitle = Str::ucfirst($originalTitle);

                if ($originalTitle === $capitalizedTitle) {
                    continue;
                }

                $product->update(['title' => $capitalizedTitle]);

                $this->info('Updated title: ' . $originalTitle . ' -> ' . $capitalizedTitle);
            }
        });
    }
}
