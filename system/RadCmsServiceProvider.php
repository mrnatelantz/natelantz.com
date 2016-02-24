<?php

namespace RadCms;

use Illuminate\Support\ServiceProvider;

class RadCmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('RadCms\Admin\AdminServiceProvider');
        $this->app->register('RadCms\Pages\PagesServiceProvider');
    }
}