<?php

Route::group(['namespace' => 'RadCms\Pages\Http\Controllers', 'middleware' => ['web','auth']], function() {


    Route::get('admin/pages', ['uses' => 'PageController@index', 'as' => 'pages.index']);
    Route::get('admin/pages/create', ['uses' => 'PageController@create', 'as' => 'pages.create.get']);
    Route::post('admin/pages', ['uses' => 'PageController@store', 'as' => 'pages.post']);
    Route::get('admin/pages/{id}', ['uses' => 'PageController@show', 'as' => 'pages.show']);
    Route::put('admin/pages/{id}', ['uses' => 'PageController@update', 'as' => 'pages.update']);
    Route::put('admin/pages/{id}/publish', ['uses' => 'PageController@publish', 'as' => 'pages.publish']);
    Route::get('admin/pages/{id}/preview', ['uses' => 'PageController@preview', 'as' => 'pages.preview']);
    Route::get('admin/pages/{id}/showVersion', ['uses' => 'PageController@showVersion', 'as' => 'pages.showVersion']);
    Route::get('admin/pages/contentType/{name}', ['uses' => 'PageController@getContentType', 'as' => 'pages.contentType']);

});


Route::get('/{slug}', ['uses' => 'RadCms\Pages\Http\Controllers\PageFrontController@find', 'middleware' => ['web']]);
