<?php

Route::group(['namespace' => 'App\Modules\Pages\Http\Controllers', 'middleware' => ['web','auth']], function() {


    Route::get('admin/pages', ['uses' => 'PageController@index', 'as' => 'pages.index']);
    Route::get('admin/pages/create', ['uses' => 'PageController@create', 'as' => 'pages.create.get']);
    Route::post('admin/pages', ['uses' => 'PageController@store', 'as' => 'pages.post']);


});

//App::before(function(){
   Route::get('/{slug}', ['uses' => 'App\Modules\Pages\Http\Controllers\PageFrontController@find', 'middleware' => ['web']]);
//});