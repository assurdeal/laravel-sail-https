<?php

namespace Assurdeal\SailHttps;

use Illuminate\Support\ServiceProvider;

class SailHttpsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/sail-https.php', 'sail-https'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/sail-https.php' => config_path('sail-https.php'),
            ], 'sail-https-config');
        }

        if (config('sail-https.enabled')) {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        }
    }
}
