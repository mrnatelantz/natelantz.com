<?php

Route::group(['prefix' => 'admin', 'namespace' => 'RadCms\Admin\Http\Controllers', 'middleware' => ['web','auth']], function() {
    Route::get('/dashboard', ['uses' => 'DashboardController@index', 'as' => 'dashboard']);
});