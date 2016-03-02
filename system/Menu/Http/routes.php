<?php

Route::group(['namespace' => 'RadCms\Menu\Http\Controllers', 'middleware' => ['web','auth']], function() {

    Route::get('admin/menu', ['uses' => 'MenuController@index', 'as' => 'menu.index']);
    Route::get('admin/menu/create', ['uses' => 'MenuController@create', 'as' => 'menu.create']);
    Route::post('admin/menu', ['uses' => 'MenuController@store', 'as' => 'menu.store']);
    Route::get('admin/menu/{id}', ['uses' => 'MenuController@edit', 'as' => 'menu.edit']);
    Route::post('admin/menu/{id}/menu_item', ['uses' => 'MenuController@storeMenuItem', 'as' => 'menu.store.menu_item']);
    Route::put('admin/menu/{id}/menu_item/{item_id}', ['uses' => 'MenuController@updateMenuItem', 'as' => 'menu.update.menu_item']);
    Route::delete('admin/menu/{id}/menu_item/{item_id}', ['uses' => 'MenuController@destroyMenuItem', 'as' => 'menu.destroy.menu_item']);
});

