<?php

namespace RadCms\Media\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MediaApiController extends Controller
{

    public function index()
    {
        $src = "http://placehold.it/300x300";
        $data = [];
        for($i = 0; $i < 15; $i++) {
            $data[] = [
                'id'            => $i,
                'name'          => 'name-'.$i,
                'description'   => 'some random text',
                'type'          => 'image',
                'item'          => [
                    'url'       => $src,
                    'height'    => '300',
                    'width'     => '300'
                ],
                'folder'        => '/'
            ];
        }

        return response()->json(['media' => $data]);

    }

}