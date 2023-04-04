<?php

declare(strict_types=1);

namespace Dystcz\Mediathor;

use Dystcz\Mediathor\Domain\Mediathor\MediaThor;
use Illuminate\Support\ServiceProvider;

class MediaThorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mediathor');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('mediathor.php'),
            ], 'config');

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/mediathor'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/mediathor.php', 'mediathor');

        // Register the main class to use with the facade
        $this->app->singleton('mediathor', function () {
            return new MediaThor;
        });
    }
}
