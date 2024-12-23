<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class SluggifyProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sluggify-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for existing products';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Product::chunk(100, function ($products) {
            foreach ($products as $product) {
                if (!$product->slug) {
                    $product->slug = null; // It's necessary to set the slug to null to trigger the sluggable package
                    $product->save();
                    $this->info("Slug generated for product ID {$product->id}: {$product->slug}");
                }
            }
        });

        $this->info('Slugs generated for all products!');
    }
}
