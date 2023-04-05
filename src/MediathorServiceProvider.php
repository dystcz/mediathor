<?php

declare(strict_types=1);

namespace Dystcz\MediaThor;

use Dystcz\MediaThor\Domain\Base\Console\Commands\InstallCommand;
use Dystcz\MediaThor\Domain\MediaThor\MediaThor;
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
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        if ($this->app->runningInConsole()) {
            // Publishing the config.
            $this->publishes([
                __DIR__.'/../config/mediathor.php' => config_path('mediathor.php'),
            ], 'config');

            // Publishing the migrations.
            // $this->publishes([
            //     __DIR__.'/../database/migrations/create_media_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_media_table.php'),
            //     // you can add any number of migrations here
            // ], 'migrations');

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/mediathor'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([
                InstallCommand::class,
            ]);
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
