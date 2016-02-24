<?php

namespace RadCms\Menu;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        Relation::morphMap([
            'menu_item' => RadCms\Menu\Models\MenuItem::class,
            'page'      => RadCms\Page\Models\Page::class,
        ]);
        */
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
