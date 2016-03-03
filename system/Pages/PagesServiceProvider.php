<?php

namespace RadCms\Pages;

use Illuminate\Support\ServiceProvider;

class PagesServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/Views', 'pages');

        view()->composer(
            'pages::admin.partials.body-content-type-selector', 'RadCms\Pages\Http\ViewComposers\ContentSelectorViewComposer'
        );
        view()->composer(
            'pages::admin.partials.head-content-type-selector', 'RadCms\Pages\Http\ViewComposers\HeadContentSelectorViewComposer'
        );
        view()->composer(
            'pages::admin.partials.foot-content-type-selector', 'RadCms\Pages\Http\ViewComposers\FootContentSelectorViewComposer'
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