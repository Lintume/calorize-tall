<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
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

    protected $description = 'Generate multiple sitemaps with a sitemap index for both languages';

    public function handle()
    {
        $this->info('Starting sitemap generation...');

        // Ensure the "sitemaps" directory exists
        $sitemapPath = public_path('sitemaps');
        if (! file_exists($sitemapPath)) {
            mkdir($sitemapPath, 0755, true); // Create directory if it doesn't exist
            $this->info("Created directory: {$sitemapPath}");
        }

        $sitemapIndex = SitemapIndex::create(); // Create the sitemap index
        $locales = ['uk', 'en']; // Supported locales
        $chunkSize = 50000;

        foreach ($locales as $locale) {
            $this->info("Generating sitemaps for locale: $locale...");

            // Static URLs for the current locale
            $staticSitemap = Sitemap::create()
                ->add(Url::create("/$locale")->setPriority(1.0)->setChangeFrequency('monthly'))
                ->add(Url::create("/$locale/products")->setPriority(0.8)->setChangeFrequency('monthly'))
                ->add(Url::create("/$locale/blog")->setPriority(0.8)->setChangeFrequency('weekly'));

            // Blog posts with modification dates for faster indexing
            $blogPosts = [
                'blog-1' => '2025-08-20',
                'blog-2' => '2025-09-05',
                'blog-3' => '2025-09-20',
                'blog-4' => '2025-10-05',
                'blog-5' => '2025-10-18',
                'blog-6' => '2025-11-01',
                'blog-7' => '2025-11-15',
                'blog-8' => '2025-11-28',
                'blog-9' => '2025-12-10',
                'blog-10' => '2025-12-20',
                'blog-11' => '2026-01-05',
                'blog-12' => '2026-01-15',
                'blog-13' => '2026-01-29',
                'blog-14' => '2026-01-29',
            ];

            foreach ($blogPosts as $routeName => $date) {
                $staticSitemap->add(
                    Url::create(route($routeName, ['locale' => $locale]))
                        ->setLastModificationDate(new \DateTime($date))
                        ->setPriority(0.7)
                        ->setChangeFrequency('monthly')
                );
            }

            // Save the static sitemap for the current locale
            $staticFilename = "sitemaps/static_sitemap_{$locale}.xml";
            $staticSitemap->writeToFile(public_path($staticFilename));
            $sitemapIndex->add("/$staticFilename");

            $this->info("Processing products for locale: $locale...");
            // Products for the current locale (exclude private user products)
            $sitemapCounter = 1;
            Product::select(['slug', 'updated_at'])
                ->whereNull('user_id')
                ->chunk($chunkSize, function ($products) use (&$sitemapCounter, $sitemapIndex, $locale) {
                $sitemap = Sitemap::create();

                foreach ($products as $product) {
                    $sitemap->add(Url::create("/$locale/product/{$product->slug}")
                        ->setLastModificationDate($product->updated_at)
                        ->setPriority(0.6)
                        ->setChangeFrequency('weekly'));
                }

                // Save the current product sitemap
                $filename = "sitemaps/products_sitemap_{$locale}_{$sitemapCounter}.xml";
                $sitemap->writeToFile(public_path($filename));

                // Add the file to the sitemap index
                $sitemapIndex->add("/$filename");
                $sitemapCounter++;
            });
        }

        // Save the sitemap index
        $sitemapIndex->writeToFile(public_path('sitemaps/sitemap_index.xml'));

        $this->info('Sitemaps generated successfully!');
    }
}
