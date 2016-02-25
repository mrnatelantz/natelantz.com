<?php
/**
 * Created by PhpStorm.
 * User: nlantz
 * Date: 2/24/16
 * Time: 11:04 AM
 */

namespace RadCms\Menu\Repository;

use RadCms\Menu\Models\Menu as MenuModel;
use RadCms\Pages\Models\Page;

class Menu
{

    protected $menu = [];

    /**
     * @param null $name
     * @return array|null
     */
    public function find($name = null)
    {
        // @todo throw an exception when null
        if(is_null($name)) { return null; }

        $menuItems = MenuModel::where('name', '=', 'main_menu')
            ->first()
            ->menu_items;

        $this->menu = [
            'name' => $name,
            'menu_items' => []
        ];

        $this->buildMenu($menuItems);

        return $this->menu;
    }

    protected function buildMenu($menuItems)
    {
        foreach($menuItems as $key => $item) {

            if($item->type == 'internal') {
                if(!is_null($item->page_id)) {
                    $this->menu['menu_items'][] = (object)[
                        'type'  => 'internal',
                        'route' => 'pages.public.find',
                        'slug'  => $item->page->slug,
                        'name'  => $item->page->name,
                        'target' => '_self'
                    ];
                }
            }
            elseif($item->type == 'external') {
                $this->menu['menu_items'][] = (object)[
                    'type'  => 'external',
                    'url'   => $item->url,
                    'name'  => $item->name,
                    'target' => '_blank'
                ];
            }

        }

    }
}