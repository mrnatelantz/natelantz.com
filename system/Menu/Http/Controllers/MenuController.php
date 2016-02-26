<?php

namespace RadCms\Menu\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use RadCms\Menu\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu::admin.index');
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
        return view('menu.edit');
    }
}
