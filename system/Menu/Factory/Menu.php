<?php

namespace RadCms\Menu\Factory;

use Illuminate\Support\Facades\Cache;
use RadCms\Menu\Models\Menu as MenuModel;
use RadCms\Menu\Models\ChildMenuItem;

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

        if(Cache::has('RadCms.menu.'.$name)) {
            return Cache::get('RadCms.menu.'.$name);
        }

        $this->buildMenu($name);
        Cache::forever('RadCms.menu.'.$name, json_decode(json_encode($this->menu)));
        return json_decode(json_encode($this->menu));
    }

    protected function buildMenu($name)
    {
        $menuItems = MenuModel::where('menus.name', '=', $name)
            ->first()
            ->menu_items()
            ->whereNotIn(
                'menu_items.id',
                ChildMenuItem::select('child_id')->get()->toArray()
            )
            ->get();

        $this->menu = [
            'name' => $name,
            'menu_items' => []
        ];

        foreach($menuItems as $key => $item) {

            $this->menu['menu_items'][] = $this->formatMenuItem($item);

            $children = [];
            foreach($item->children as $child) {
                $children[] = $this->formatMenuItem($child->child_item);
            }
            //if(!empty($children)) {
                $this->menu['menu_items'][$key]['children'] = $children;
            //}

        }

    }

    /**
     * Responsible for formatting data from db into usable object
     * @param $item
     * @return array
     */
    protected function formatMenuItem($item)
    {
        $result = [];
        if($item->type == 'internal') {
            if(!is_null($item->page_id)) {
                $result = [
                    'type'  => 'internal',
                    'route' => 'pages.public.find',
                    'slug'  => $item->page->slug,
                    'name'  => $item->page->name,
                    'target' => '_self'
                ];
            }
        }
        elseif($item->type == 'external') {
            $result = [
                'type'  => 'external',
                'url'   => $item->url,
                'name'  => $item->name,
                'target' => '_blank'
            ];
        }
        return $result;
    }
}