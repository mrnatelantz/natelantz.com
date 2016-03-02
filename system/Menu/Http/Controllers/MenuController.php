<?php

namespace RadCms\Menu\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use RadCms\Menu\Models\Menu;
use RadCms\Menu\Factory\Menu as MenuFactory;
use RadCms\Pages\Models\Page;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu::admin.index', ['menus' => Menu::all()]);
    }

    public function create()
    {
        return view('menu::admin.create');
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->input('name')
        ];
        $menu = Menu::create($data);
        return redirect()->route('menu.edit', ['id' => $menu->id]);
    }

    public function edit($id)
    {
        $menu = new MenuFactory();
        return view('menu::admin.edit', [
            'menu'  => $menu->findRaw($id)->first(),
            'pages' => Page::all()
        ]);
    }

    public function storeMenuItem($id, Request $request)
    {
        $menu_item = $request->input();
        $menu_item['menu_id'] = $id;
        $menuFactory = new MenuFactory();
        $menuFactory->createItem($menu_item);
        return redirect()->route('menu.edit', ['id' => $id]);
    }

    public function updateMenuItem($id, $item_id, Request $request)
    {
        $menu_item = [
            'menu_id'   => $item_id,
            'type'      => $request->input('type'),
            'name'      => $request->input('name'),
            'page_id'   => $request->input('page_id'),
            'target'    => $request->input('target'),
            'url'       => $request->input('url')
        ];
        $menuFactory = new MenuFactory();
        $menuFactory->updateItem($menu_item);
        return redirect()->route('menu.edit', ['id' => $id]);
    }

    public function destroyMenuItem($id, $item_id)
    {
        $menuFactory = new MenuFactory();
        $menuFactory->destroyItem($item_id);
        return redirect()->route('menu.edit', ['id' => $id]);
    }
}
