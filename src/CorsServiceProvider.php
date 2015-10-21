<?php

namespace ResultSystems\Cors;

use Illuminate\Support\ServiceProvider;

class CorsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     */
    public function boot()
    {
    }

    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/config.php' => config_path('cors.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/config.php', 'cors'
        );
    }
}
