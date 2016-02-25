<?php
/**
 * @tip Do not use the full namespace with factories, it will not find it.
 * Make sure to include the namespace at the top of the file
 * @example
 * $menuFactory = factory(Menu::class)->make(); // Good
 * $menuFactory = factory(RadCms\Menu\Models\Menu::class)->make(); // Bad
 */
namespace RadCmsTests\Menu;

use RadCms\Menu\Models\Menu;
use RadCms\Menu\Models\MenuItem;
use RadCms\Menu\Models\ChildMenuItem;

use RadCms\Pages\Models\Page;

trait MenuBuilder
{

    /** @before */
    function buildMenu()
    {
        // create menu object
        $menuFactory = factory(Menu::class)->make();
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
            [
                'menu_id'   => 1,
                'type'      => 'internal',
                'page_id'   => 2,
                'name'      => 'Internal Page 2',
                'url'       => null,
                'target'    => '_self'
            ],
            [
                'menu_id'   => 1,
                'type'      => 'internal',
                'page_id'   => 3,
                'name'      => 'Internal Page',
                'url'       => null,
                'target'    => '_self'
            ]


        ];
        foreach($menuItemFactory as $item) {
            MenuItem::create($item);
        }

        $child_menu_items = [
            [
                'parent_id' => 1,
                'child_id'  => 3
            ],
            [
                'parent_id' => 1,
                'child_id'  => 4
            ]
        ];

        foreach($child_menu_items as $child) {
            ChildMenuItem::create($child);
        }


        // add page for menu item to reference
        $pageFactory = factory(Page::class)->make();
        Page::create($pageFactory['attributes']);
        $pageFactory = factory(Page::class)->make();
        Page::create($pageFactory['attributes']);
        $pageFactory = factory(Page::class)->make();
        Page::create($pageFactory['attributes']);
    }
}