<?php

namespace Gdinko\Acs;

use Illuminate\Support\ServiceProvider;

class AcsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/acs.php' => config_path('acs.php'),
            ], 'config');
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
