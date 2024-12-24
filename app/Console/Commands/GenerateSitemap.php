<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate multiple sitemaps with a sitemap index';

    public function handle()
    {
        $this->info('Starting sitemap generation...');

        // Ensure the "sitemaps" directory exists
        $sitemapPath = public_path('sitemaps');
        if (!file_exists($sitemapPath)) {
            mkdir($sitemapPath, 0755, true); // Create directory if it doesn't exist
            $this->info("Created directory: {$sitemapPath}");
        }

        $sitemapIndex = SitemapIndex::create(); // Create the sitemap index
        $chunkSize = 50000;
        $sitemapCounter = 1;

        $this->info('Generating static URLs...');
        $staticSitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('monthly'))
            ->add(Url::create('/products')->setPriority(0.8)->setChangeFrequency('monthly'))
            ->add(Url::create('/blog')->setPriority(0.8)->setChangeFrequency('monthly'))
            ->add(Url::create('/blog/yak-pravylno-rakhuvaty-kaloriyi-dlya-skhudnennya-praktychnyy-gid')->setPriority(0.8)->setChangeFrequency('monthly'));

        // Save the static sitemap
        $staticSitemap->writeToFile(public_path('sitemaps/static_sitemap.xml'));
        $sitemapIndex->add('/sitemaps/static_sitemap.xml');

        $this->info('Processing products...');
        \App\Models\Product::select(['slug', 'updated_at'])->chunk($chunkSize, function ($products) use (&$sitemapCounter, $sitemapIndex) {
            $sitemap = Sitemap::create();

            foreach ($products as $product) {
                $sitemap->add(Url::create("/product/{$product->slug}")
                    ->setLastModificationDate($product->updated_at)
                    ->setPriority(0.6)
                    ->setChangeFrequency('weekly'));
            }

            // Save the current sitemap
            $filename = "sitemaps/products_sitemap_{$sitemapCounter}.xml";
            $sitemap->writeToFile(public_path($filename));

            // Add the file to the sitemap index
            $sitemapIndex->add("/$filename");
            $sitemapCounter++;
        });

        // Save the sitemap index
        $sitemapIndex->writeToFile(public_path('sitemaps/sitemap_index.xml'));

        $this->info('Sitemaps generated successfully!');
    }
}