<?php

namespace App\Modules\Pages\Http\Controllers;

namespace App\Modules\Pages\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\Pages\Models\Page;

class PageFrontController extends Controller
{

    public function find(Request $request, $slug)
    {
        //dd($slug);
        $page = Page::where('slug', '=', $slug)->first();
        $template = (isset($page->template) && !is_null($page->template)) ? $page->template : 'page';
        return view($template, ['page' => $page]);
    }
}