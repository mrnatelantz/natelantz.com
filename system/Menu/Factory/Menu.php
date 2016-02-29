<?php

namespace RadCms\Menu\Factory;

use Illuminate\Support\Facades\Cache;
use RadCms\Menu\Models\Menu as MenuModel;
use RadCms\Menu\Models\ChildMenuItem;
use RadCms\Menu\Models\MenuItem;

class Menu
{

    protected $menu;

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
        return $this->menu;
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

    public function findRaw($id = null)
    {
        $menu = [];
        if(is_null($id)) {
            $menu = MenuModel::with('menu_items')
                ->with(['menu_items' => function ($query) {
                    $query->whereNotIn(
                        'menu_items.id',
                        ChildMenuItem::select('child_id')->get()->toArray()
                    )
                        ->with(['children' => function($query2) {
                            $query2->with('child_item');
                        }]);
                }])
                ->get();
        }
        else {
            $menu = MenuModel::find($id)
                ->first()
                //->with('menu_items')
                ->with(['menu_items' => function ($query) {
                    $query->whereNotIn(
                        'menu_items.id',
                        ChildMenuItem::select('child_id')->get()->toArray()
                    )
                        ->with(['children' => function($query2) {
                            $query2->with('child_item');
                        }]);
                }])
                ->first();
        }
        return $this->addToCollection($menu);
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
        $menu = MenuModel::where('menus.name', '=', $name)
            ->first()
            ->with(['menu_items' => function ($query) {
                $query->whereNotIn(
                    'menu_items.id',
                    ChildMenuItem::select('child_id')->get()->toArray()
                );
            }])
            ->first();

        $this->menu = [
            'name' => $name,
            'menu_items' => []
        ];

        foreach($menu->menu_items as $key => $item) {

            $this->menu['menu_items'][] = $this->formatMenuItem($item);

            $children = [];
            foreach($item->children as $child) {
                $children[] = $this->formatMenuItem($child->child_item);
            }
            $this->menu['menu_items'][$key]['children'] = $children;
        }
        $this->menu = $this->addToCollection($this->menu);
        Cache::forever('RadCms.menu.'.$name, $this->menu);

    }

    protected function addToCollection($data, $asObject = true)
    {
        if($asObject) {
            return collect(json_decode(json_encode($data)));
        }
        else {
            return $data;
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