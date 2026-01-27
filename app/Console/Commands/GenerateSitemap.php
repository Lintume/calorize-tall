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
                ->add(Url::create("/$locale/blog")->setPriority(0.8)->setChangeFrequency('monthly'))
                ->add(Url::create(route('blog-1', ['locale' => $locale])))
                ->add(Url::create(route('blog-2', ['locale' => $locale])))
                ->add(Url::create(route('blog-3', ['locale' => $locale])))
                ->add(Url::create(route('blog-4', ['locale' => $locale])))
                ->add(Url::create(route('blog-5', ['locale' => $locale])))
                ->add(Url::create(route('blog-6', ['locale' => $locale])))
                ->add(Url::create(route('blog-7', ['locale' => $locale])))
                ->add(Url::create(route('blog-8', ['locale' => $locale])))
                ->add(Url::create(route('blog-9', ['locale' => $locale])))
                ->add(Url::create(route('blog-10', ['locale' => $locale])))
                ->add(Url::create(route('blog-11', ['locale' => $locale])))
                ->add(Url::create(route('blog-12', ['locale' => $locale])))
                ->add(Url::create(route('blog-13', ['locale' => $locale])));

            // Save the static sitemap for the current locale
            $staticFilename = "sitemaps/static_sitemap_{$locale}.xml";
            $staticSitemap->writeToFile(public_path($staticFilename));
            $sitemapIndex->add("/$staticFilename");

            $this->info("Processing products for locale: $locale...");
            // Products for the current locale
            $sitemapCounter = 1;
            Product::select(['slug', 'updated_at'])->chunk($chunkSize, function ($products) use (&$sitemapCounter, $sitemapIndex, $locale) {
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
