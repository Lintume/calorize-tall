<?php

namespace App\Providers;

use App\Services\Prism\GeminiWithHelicone;
use App\Support\Helicone;
use Illuminate\Support\ServiceProvider;
use Prism\Prism\PrismManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register custom Gemini provider with Helicone support
        if (Helicone::enabled()) {
            $this->app->make(PrismManager::class)->extend('gemini', function () {
                // Helicone gateway base URL without /v1 suffix
                $gatewayBase = rtrim(config('helicone.gateway_url'), '/');
                // Remove /v1 suffix if present
                if (str_ends_with($gatewayBase, '/v1')) {
                    $gatewayBase = substr($gatewayBase, 0, -3);
                }

                return new GeminiWithHelicone(
                    apiKey: config('prism.providers.gemini.api_key'),
                    url: $gatewayBase . '/v1beta/models',
                    heliconeApiKey: config('helicone.api_key'),
                );
            });
        }
    }
}
