<?php

namespace RadCms\Pages\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use RadCms\Pages\Models\Page;
use RadCms\Pages\Models\PageVersions;
use View;
use RadCms\Pages\Templates\Template;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages::admin.index', [
            'pages' => Page::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = new Template();
        return view('pages::admin.form',[
            'templates' => $templates->all()
        ]);
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
        $page->head = $request->input('head');
        $page->body = $request->input('body');
        $page->foot = $request->input('foot');
        $page->template = $request->input('template');
        $page->save();

        $pageVersion = new PageVersions();
        $pageVersion->page_id      = $page->id;
        $pageVersion->slug         = $request->input('slug');
        $pageVersion->name         = $request->input('name');
        $pageVersion->cover_image  = $request->input('cover_image');
        $pageVersion->head         = $request->input('head');
        $pageVersion->body         = $request->input('body');
        $pageVersion->foot         = $request->input('foot');
        $pageVersion->template     = $request->input('template');
        $pageVersion->save();

        return redirect()->route('pages.show', ['id' => $page->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $templates = new Template();

        $page = PageVersions::where('page_id', '=', $id)
            ->orderBy('id', 'desc')
            ->first();
        $versions = PageVersions::where('page_id', '=', $id)
                    ->orderBy('id', 'desc')
                    ->get();
        $published = Page::where('id', '=', $id)
                        ->pluck('published')
                        ->first();
        return view('pages::admin.form', [
            'page'      => $page,
            'versions'  => $versions,
            'templates' => $templates->all(),
            'page_id'   => $id,
            'published' => $published
        ]);
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
            'head' => $request->input('head'),
            'body' => $request->input('body'),
            'foot' => $request->input('foot'),
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
            'head' => $request->input('head'),
            'body' => $request->input('body'),
            'foot' => $request->input('foot'),
            'template' => $request->input('template')
        ]);

        Page::where('id', '=', $id)
            ->update([
                'slug' => $request->input('slug'),
                'name' => $request->input('name'),
                'cover_image' => $request->input('cover_image'),
                'head' => json_encode($request->input('head')), // mutator doesnt work on update
                'body' => json_encode($request->input('body')), // mutator doesnt work on update
                'foot' => json_encode($request->input('foot')), // mutator doesnt work on update
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
        Page::where('id', '=', $id)
            ->delete();
        PageVersions::where('page_id', '=', $id)
            ->delete();
        return redirect()->route('pages.index');
    }

    public function unPublish($id)
    {
        Page::where('id', '=', $id)
            ->update(['published' => 0]);
        return redirect()->route('pages.show', ['id' => $id]);

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

    /**
     * Only checks for published pages
     * Does not check page versions
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     * @todo need to exclude the same page
     */
    public function checkSlug($page_id, $slug)
    {
        $page = Page::where('slug', '=', $slug)
                        ->where('id', '<>', $page_id)
                        ->select('id', 'slug', 'name', 'published')
                        ->first();

        if($page) {
            if($page->published == 1){
                return response()->json([
                    'status' => true,
                    'page' => $page
                ]);
            }
            else {
                return response()->json([
                    'status' => false
                ]);
            }

        }
        else {
            return response()->json([
                'status' => false
            ]);
        }

        return null;

    }
}
