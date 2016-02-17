<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [
        'as' => 'home', 'uses' => 'HomeController@index'
    ]);

    
    Route::group(['namespace' => 'Auth'], function() {
    	Route::get('/login', 'AuthController@getLogin');
	    Route::post('/login', 'AuthController@postLogin');
	    Route::get('/logout', ['uses' => 'AuthController@logout', 'as' => 'logout']);
    });
    
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['web','auth']], function() {
    Route::get('/dashboard', ['uses' => 'DashboardController@index', 'as' => 'dashboard']);

});

/*
Route::group(['middleware' => 'web'], function () {
    Route::auth();
});

*/