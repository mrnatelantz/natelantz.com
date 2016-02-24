<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use RadCms\Menu\Models\Menu;

class MenuModelTest extends TestCase
{

    /** @test */
    function it_should_have_links()
    {
        //$menu = Menu::where('name', '=', 'main_menu')->first();

        $menu = [
            'name' => 'main_menu',
            'menu_items' => [
                0 => [
                    'type'      => 'internal',
                    'page_id'   => 1,
                    'name'      => null,
                    'url'       => null
                ],
                1 => [
                    'type'      => 'external',
                    'page_id'   => null,
                    'name'      => 'RadCms',
                    'url'       => '//radcms.natelantz.com'
                ]
            ]
        ];

    }
}
