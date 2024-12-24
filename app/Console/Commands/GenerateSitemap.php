<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Create a new sitemap instance
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('monthly'))
            ->add(Url::create('/products')->setPriority(0.8)->setChangeFrequency('monthly'));

//        SitemapGenerator::create('http://calorize-tall.test')->writeToFile(public_path('sitemap.xml'));

        // Dynamically add URLs for products (or any other dynamic content)
        $products = \App\Models\Product::all();
        foreach ($products as $product) {
            $sitemap->add(Url::create("/product/{$product->slug}")
                ->setLastModificationDate($product->updated_at)
                ->setPriority(0.6)
                ->setChangeFrequency('weekly'));
        }

        // Write the sitemap to the public folder
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}