<?php

Route::group(['namespace' => 'RadCms\Menu\Http\Controllers', 'middleware' => ['web','auth']], function() {

    Route::get('admin/menu', ['uses' => 'MenuController@index', 'as' => 'menu.index']);
    Route::get('admin/menu/create', ['uses' => 'MenuController@create', 'as' => 'menu.create']);
    Route::post('admin/menu', ['uses' => 'MenuController@store', 'as' => 'menu.store']);
    Route::get('admin/menu/{id}', ['uses' => 'MenuController@edit', 'as' => 'menu.edit']);

});

