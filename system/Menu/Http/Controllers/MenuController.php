<?php

namespace RadCms\Menu\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use RadCms\Menu\Models\Menu;
use RadCms\Menu\Factory\Menu as MenuFactory;

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
        return Redirect(route('menu.edit', ['id' => $menu->id]));
    }

    public function edit($id)
    {
        $menu = new MenuFactory();
        return view('menu::admin.edit', ['menu' => $menu->findRaw($id)]);
    }
}
