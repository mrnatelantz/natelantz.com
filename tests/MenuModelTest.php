<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use RadCms\Menu\Models\Menu;
use RadCms\Menu\Models\MenuItem;
use RadCms\Pages\Models\Page;

class MenuModelTest extends TestCase
{

    use DatabaseTransactions;

    /** @before */
    function buildMenu()
    {
        // create menu object
        $menuFactory = factory(RadCms\Menu\Models\Menu::class)->make();
        Menu::create($menuFactory['attributes']);

        // add menu items
        $menuItemFactory = [
            [
                'menu_id'   => 1,
                'type'      => 'internal',
                'page_id'   => 1,
                'name'      => 'Internal Page',
                'url'       => null,
                'target'    => '_self'
            ],
            [
                'menu_id'   => 1,
                'type'      => 'external',
                'page_id'   => null,
                'name'      => 'Google',
                'url'       => '//google.com',
                'target'    => '_blank'
            ],


        ];
        foreach($menuItemFactory as $item) {
            MenuItem::create($item);
        }

        // add page for menu item to reference
        $pageFactory = factory(RadCms\Pages\Models\Page::class)->make();
        Page::create($pageFactory['attributes']);
    }

    /** @test */
    function it_should_have_a_menu_object()
    {
        $menu = Menu::where('name', '=', 'main_menu')->first();
        $this->assertGreaterThan(0, count($menu));
    }

    /** @test */
    function the_menu_should_have_items()
    {



        dd($result);
    }

}


$literal = [
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
            'url'       => '//some.site.com'
        ]
    ]
];

$expected = [
    'name' => 'main_menu',
    'menu_items' => [
        0 => [
            'type'  => 'internal',
            'route' => 'pages.public.find',
            'slug'  => 'my-page',
            'name'  => 'My Page',
            'target' => '_self'
        ],
        1 => [
            'type'  => 'external',
            'url'   => '//some.site.com',
            'name'  => 'RadCms',
            'target' => '_blank'
        ]
    ]
];