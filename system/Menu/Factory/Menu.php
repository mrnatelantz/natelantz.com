<?php

namespace RadCms\Menu\Factory;

use Illuminate\Support\Facades\Cache;
use RadCms\Menu\Models\Menu as MenuModel;
use RadCms\Menu\Models\ChildMenuItem;
use RadCms\Menu\Models\MenuItem;

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

        return json_decode(json_encode($this->menu));
    }

    /**
     * @param array $menu
     * @return static
     */
    public function create(array $menu = [])
    {
        return MenuModel::create($menu);
    }

    /**
     * @param array $menuItems
     * @return bool
     */
    public function createItem(array $menuItems = [])
    {
        $menu_id = 0;
        $items = [];
        // multi dimensional array, more than one item
        if (count($menuItems) != count($menuItems, 1))
        {
            $menu_id = $menuItems[0]['menu_id'];
            foreach($menuItems as $item) {
                if(!$items[] = $this->addItem($item)) {
                    return false;
                }
            }
        }
        else
        {
            $menu_id = $menuItems['menu_id'];
            if(!$items[] = $this->addItem($menuItems)) {
                return false;
            }
        }

        $menuName = MenuModel::find($menu_id)
                        ->pluck('name')
                        ->first();
        // rebuild menu cache
        $this->buildMenu($menuName);
        return $items;
    }

    /**
     * @param $item
     * @return static
     */
    protected function addItem($item)
    {
        $menuItem = MenuItem::create($item);
        if(isset($item['parent_id']) && !is_null($item['parent_id']))
        {
            ChildMenuItem::create([
                'parent_id' => $item['parent_id'],
                'child_id'  => $menuItem->id
            ]);
        }
        return $menuItem;

    }

    /**
     * @param $name
     */
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
            $this->menu['menu_items'][$key]['children'] = $children;
        }

        Cache::forever('RadCms.menu.'.$name, json_decode(json_encode($this->menu)));

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