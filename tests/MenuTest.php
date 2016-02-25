<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use RadCms\Menu\Models\Menu;
use RadCms\Menu\Models\MenuItem;
use RadCms\Pages\Models\Page;

use RadCms\Menu\Repository\Menu as MenuRepo;

class MenuTest extends TestCase
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
                'parent_id' => 1,
                'type'      => 'internal',
                'page_id'   => 1,
                'name'      => 'Internal Page',
                'url'       => null,
                'target'    => '_self'
            ],
            [
                'menu_id'   => 1,
                'parent_id' => null,
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
    function the_menu_should_have_menu_items()
    {
        $name = 'main_menu';
        $menuRepo = new MenuRepo();

        $menu = $menuRepo->find($name);
        $this->assertEquals($name, $menu->name);

        $this->assertGreaterThan(0, count($menu->menu_items));

    }

    /** @test */
    function internal_and_external_menu_items_should_be_different_and_have_the_structure()
    {
        $name = 'main_menu';
        $menuRepo = new MenuRepo();

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
        $menuRepo = new MenuRepo();
        $menu = $menuRepo->find();
        $this->assertNull($menu);
    }


    /** @test */
    function menu_items_can_have_child_menu_items()
    {
        $name = 'main_menu';
        $menuRepo = new MenuRepo();

        $menu = $menuRepo->find($name);

        foreach($menu->menu_items as $item) {
            $this->assertObjectHasAttribute('children', $item);
            if(isset($item->children)) {
                $this->assertGreaterThan(0, count($item->children));
            }

        }
    }

}
