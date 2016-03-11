<?php

Route::group(['namespace' => 'RadCms\Media\Http\Controllers', 'prefix' => 'admin/media' ,'middleware' => ['web','auth']], function() {

    Route::get('/', ['uses' => 'MediaController@index', 'as' => 'media.index']);

    Route::group(['prefix' => 'api'], function(){
        Route::get('/', ['uses' => 'MediaApiController@index', 'as' => 'media.api.index']);
    });



});