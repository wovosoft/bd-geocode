<?php

namespace Wovosoft\BdGeocode;

use Illuminate\Support\ServiceProvider;
use Wovosoft\BdGeocode\Commands\CloneData;
use Wovosoft\BdGeocode\Commands\ImportData;


class BdGeocodeServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'wovosoft');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bd-geocode');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        /**
         * Found an issue with registering routes from package.
         * When routes are registered from package, model dependency injection doesn't work properly.
         * I still didn't find the solution, so for now lets disabled the route registration from here
         * and let the application itself register routes either in web.php or api.php
         */
//        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/bd-geocode.php', 'bd-geocode');

        // Register the service the package provides.
        $this->app->singleton('bd-geocode', function ($app) {
            return new BdGeocode;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['bd-geocode'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/bd-geocode.php' => config_path('bd-geocode.php'),
        ], 'bd-geocode.config');

        // Publishing the migrations.
        $this->publishes([
            __DIR__ . '/../database/migrations' => base_path('database/migrations'),
        ], 'bd-geocode.migrations');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/wovosoft'),
        ], 'bd-geocode.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/wovosoft'),
        ], 'bd-geocode.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/wovosoft'),
        ], 'bd-geocode.views');*/

        // Registering package commands.
        $this->commands([
            CloneData::class,
            ImportData::class
        ]);
    }
}
