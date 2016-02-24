<?php
/**
 * Created by PhpStorm.
 * User: nlantz
 * Date: 2/24/16
 * Time: 11:04 AM
 */

namespace RadCms\Menu\Repository;

use RadCms\Menu\Models\Menu;

class Menu
{

    public function find($name = null)
    {
        $menuItems = Menu::where('name', '=', 'main_menu')
            ->first()
            ->menu_items;

        $result = [
            'name' => 'main_menu',
            'menu_items' => []
        ];

        foreach($menuItems as $item) {

            if($item->type == 'internal') {
                if(!is_null($item->page_id)) {
                    $result['menu_items'][] = [
                        'type'  => 'internal',
                        'route' => 'pages.public.find',
                        'slug'  => $item->page->slug,
                        'name'  => $item->page->name,
                        'target' => '_self'
                    ];
                }
            }
            elseif($item->type == 'external') {
                $result['menu_items'][] = [
                    'type'  => 'external',
                    'url'   => $item->url,
                    'name'  => $item->name,
                    'target' => '_blank'
                ];
            }

        }

        return $result;
    }
}