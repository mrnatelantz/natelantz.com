<?php

namespace RadCms\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }
        $this->loadViewsFrom(__DIR__.'/Views', 'radcms');

        view()->composer(
            'radcms::layouts.module-nav', 'RadCms\Admin\Http\ViewComposers\AdminModuleNavViewComposer'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}