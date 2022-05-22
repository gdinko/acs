<?php

namespace Gdinko\Acs;

use Gdinko\Acs\Commands\GetCarrierAcsApiStatus;
use Illuminate\Support\ServiceProvider;

class AcsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/acs.php' => config_path('acs.php'),
            ], 'acs-config');

            $this->publishes([
                __DIR__ . '/../database/migrations/' => database_path('migrations'),
            ], 'acs-migrations');

            $this->publishes([
                __DIR__ . '/Models/' => app_path('Models'),
            ], 'acs-models');

            $this->publishes([
                __DIR__ . '/Commands/' => app_path('Console/Commands'),
            ], 'acs-commands');

            // Registering package commands.
            $this->commands([
                GetCarrierAcsApiStatus::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/acs.php', 'acs');

        // Register the main class to use with the facade
        $this->app->singleton('acs', function () {
            return new Acs();
        });
    }
}
