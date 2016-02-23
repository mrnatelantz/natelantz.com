<?php

namespace App\Modules\Pages\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\Pages\Models\Page;
use App\Modules\Pages\Models\PageVersions;
use View;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages::admin.index', ['pages' => Page::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages::admin.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page();
        $page->slug = $request->input('slug');
        $page->name = $request->input('name');
        $page->cover_image = $request->input('cover_image');
        $page->content = $request->input('content');
        $page->template = $request->input('template');
        $page->save();

        $pageVersion = new PageVersions();
        $pageVersion->page_id      = $page->id;
        $pageVersion->slug         = $request->input('slug');
        $pageVersion->name         = $request->input('name');
        $pageVersion->cover_image  = $request->input('cover_image');
        $pageVersion->content      = $request->input('content');
        $pageVersion->template     = $request->input('template');
        $pageVersion->save();

        return Redirect(route('pages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = PageVersions::where('page_id', '=', $id)
            ->orderBy('id', 'desc')
            ->first();
        $versions = PageVersions::where('page_id', '=', $id)
                    ->orderBy('id', 'desc')
                    ->get();
        return view('pages::admin.form', ['page' => $page, 'versions' => $versions]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * This shows the latest saved version of the page, must be logged in
     */
    public function preview($id)
    {
        $page = PageVersions::where('page_id', '=', $id)
            ->orderBy('id', 'desc')
            ->first();
        return view('page', ['page' => $page]);
    }

    public function showVersion($id)
    {
        $page = PageVersions::find($id);
        return view('page', ['page' => $page]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        PageVersions::create([
            'page_id' => $id,
            'slug' => $request->input('slug'),
            'name' => $request->input('name'),
            'cover_image' => $request->input('cover_image'),
            'content' => $request->input('content'),
            'template' => $request->input('template')
        ]);
        return Redirect(route('pages.show', ['id' => $id]));
    }


    public function publish(Request $request, $id)
    {
        PageVersions::create([
            'page_id' => $id,
            'slug' => $request->input('slug'),
            'name' => $request->input('name'),
            'cover_image' => $request->input('cover_image'),
            'content' => $request->input('content'),
            'template' => $request->input('template')
        ]);

        Page::where('id', '=', $id)
            ->update([
                'slug' => $request->input('slug'),
                'name' => $request->input('name'),
                'cover_image' => $request->input('cover_image'),
                'content' => json_encode($request->input('content')), // mutator doesnt work on update
                'template' => $request->input('template'),
                'published' => true
            ]);

        return Redirect(route('pages.show', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $name
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function getContentType($name)
    {
        $data = [
            'html' => '',
            'status' => false,
        ];

        $contentType = [
            'content' => '',
            'orderByCount' => '',
            'ajax' => true,
        ];
        /**
         * @todo Refactor this logic into a Facade.
         * It would be nice to have a clean way to load views while
         * supporting user defined content types
         */
        if(View::exists('admin.content-types.' . $name)) {

            $view = View::make('pages::admin.content-types.'.$name, ['contentType' => $contentType]);
            $data = [
                'html' => $view->render(),
                'status' => true,
            ];
        }
        elseif(View::exists('pages::admin.content-types.' . $name)) {

            $view = View::make('pages::admin.content-types.'.$name, ['contentType' => $contentType]);
            $data = [
                'html' => $view->render(),
                'status' => true,
            ];
        }

        return response()->json($data);
    }
}
