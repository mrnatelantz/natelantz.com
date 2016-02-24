<?php
/**
 * All RadCms Modules get loaded here with the exception of this one file.
 * This is loaded in config/app.php
 */

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
        $this->app->register('RadCms\Menu\MenuServiceProvider');
    }
}