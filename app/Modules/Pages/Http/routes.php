<?php

Route::group(['namespace' => 'App\Modules\Pages\Http\Controllers', 'middleware' => ['web','auth']], function() {


    Route::get('admin/pages', ['uses' => 'PageController@index', 'as' => 'pages.index']);
    Route::get('admin/pages/create', ['uses' => 'PageController@create', 'as' => 'pages.create.form']);


});