<?php

namespace RadCms\Pages\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use RadCms\Pages\Models\Page;

class PageFrontController extends Controller
{

    public function find(Request $request, $slug)
    {
        $page = Page::where('slug', '=', $slug)->first();
        $template = (isset($page->template) && !is_null($page->template)) ? $page->template : 'page';
        return view($template, ['page' => $page]);
    }
}