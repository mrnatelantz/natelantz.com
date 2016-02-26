<?php

Route::group(['namespace' => 'RadCms\Menu\Http\Controllers', 'middleware' => ['web','auth']], function() {

    Route::get('admin/menu', ['uses' => 'MenuController@index', 'as' => 'menu.index']);

});

