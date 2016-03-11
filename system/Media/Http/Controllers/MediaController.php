<?php

namespace RadCms\Media\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{

    public function index(Request $request)
    {
        return view('media::admin.index');
    }

}