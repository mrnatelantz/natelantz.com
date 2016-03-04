<?php

namespace RadCms\Media;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }
        $this->loadViewsFrom(__DIR__ . '/Views', 'media');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}