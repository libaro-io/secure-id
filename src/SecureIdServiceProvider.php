<?php

namespace Libaro\SecureId;

use Illuminate\Support\ServiceProvider;

class SecureIdServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
         $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('secure-id.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'secure-id');

        $this->app->singleton('secure-id', function () {
            return new SecureId;
        });
    }
}
