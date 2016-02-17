<?php

Route::group(['namespace' => 'App\Modules\Pages\Http\Controllers'], function() {


    Route::get('admin/pages', ['uses' => 'PageController@index', 'as' => 'pages.index']);



});