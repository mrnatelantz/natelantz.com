<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use RadCms\Menu\Models\Menu;
use RadCms\Menu\Models\ChildMenuItem;
use RadCmsTests\Menu\MenuBuilder;

use RadCms\Menu\Factory\Menu as MenuFactory;

class MenuTest extends TestCase
{

    use DatabaseTransactions, MenuBuilder;

    /** @test */
    function it_should_have_a_menu_object()
    {
        $menu = Menu::where('name', '=', 'main_menu')->first();

        $this->assertGreaterThan(0, count($menu));
    }

    /** @test */
    function the_menu_should_have_menu_items()
    {
        $name = 'main_menu';
        $menuRepo = new MenuFactory();

        $menu = $menuRepo->find($name);
        $this->assertEquals($name, $menu->name);

        $this->assertGreaterThan(0, count($menu->menu_items));

    }

    /** @test */
    function internal_and_external_menu_items_should_be_different_and_have_the_structure()
    {
        $name = 'main_menu';
        $menuRepo = new MenuFactory();

        $menu = $menuRepo->find($name);

        foreach($menu->menu_items as $item) {
            $this->assertObjectHasAttribute('type', $item);
            $this->assertObjectHasAttribute('name', $item);
            $this->assertObjectHasAttribute('target', $item);

            if($item->type == 'internal') {
                $this->assertObjectHasAttribute('route', $item);
                $this->assertObjectHasAttribute('slug', $item);

            }
            elseif($item->type == 'external') {
                $this->assertObjectHasAttribute('url', $item);
            }
        }
    }


    /** @test */
    function it_should_be_null_without_a_name()
    {
        $menuRepo = new MenuFactory();
        $menu = $menuRepo->find();
        $this->assertNull($menu);
    }


    /** @test */
    function menu_items_can_have_child_menu_items()
    {
        $name = 'main_menu';
        $menuRepo = new MenuFactory();

        $menu = $menuRepo->find($name);

        foreach($menu->menu_items as $item) {
            // children might be null, but should exist
            $this->assertObjectHasAttribute('children', $item);
        }
    }

    /**
     * The below are related to creating
     */

    /** @test */
    function it_should_be_able_to_make_a_new_menu()
    {
        $name = 'test_menu';
        $menuFactory = new MenuFactory();
        $menu = $menuFactory->create(['name' => $name]);
        $this->assertInstanceOf(Menu::class, $menu);
        $this->assertEquals($name, $menu->name);
    }

    /** @test */
    function it_should_be_able_to_add_one_menu_item()
    {
        $menuItems = [
            'menu_id'   => 1,
            'type'      => 'external',
            'page_id'   => null,
            'name'      => 'External Test Page',
            'url'       => '//example.com',
            'target'    => '_blank'
        ];

        $menuFactory = new MenuFactory();

        $res = $menuFactory->createItem($menuItems);

        $this->assertNotNull($res);


    }

    /** @test */
    function it_should_be_able_to_add_multiple_menu_items()
    {
        $menuItems = [
            [
                'menu_id'   => 1,
                'type'      => 'external',
                'page_id'   => null,
                'name'      => 'External Test Page',
                'url'       => '//example.com',
                'target'    => '_blank'
            ],
            [
                'menu_id'   => 1,
                'type'      => 'internal',
                'page_id'   => 1,
                'name'      => null,
                'url'       => null,
                'target'    => '_self'
            ]

        ];

        $menuFactory = new MenuFactory();

        $res = $menuFactory->createItem($menuItems);

        $this->assertNotNull($res);


    }


    /** @test  */
    function it_should_be_able_to_create_child_menu_items()
    {
        $childItem = [
            'menu_id'   => 1,
            'parent_id' => 2,
            'type'      => 'external',
            'page_id'   => null,
            'name'      => 'External Test Page',
            'url'       => '//example.com',
            'target'    => '_blank'
        ];
        $menuFactory = new MenuFactory();

        // returns an array of items created
        $res = $menuFactory->createItem($childItem);
        $this->assertNotNull($res);

        $child = ChildMenuItem::where('parent_id', '=', $childItem['parent_id'])
                            ->where('child_id', '=', $res[0]->id)->get();
        $this->assertNotNull($child);
    }

    /** @test */
    function it_gets_a_raw_menu()
    {
        $menuFactory = new MenuFactory();
        $menu = $menuFactory->findRaw(1);
        // terrible test, should be more descriptive
        $this->assertNotNull($menu);
    }

    /** @test */
    function it_gets_all_menus_raw()
    {
        $menuFactory = new MenuFactory();
        $menu = $menuFactory->findRaw();
        // terrible test, should be more descriptive
        $this->assertNotNull($menu);
    }

}
