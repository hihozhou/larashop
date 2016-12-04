<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

//Route::get('/home', 'HomeController@index');

/**
 * Admin group
 */
Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
    ],
    function () {
        Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('admin.logout');

        //need auth
        Route::group(['middleware' => ['admin.auth']], function () {
            Route::get('/', 'IndexController@index');
            Route::get('/index', 'IndexController@index');

            // ...
        });
//        Route::get('/account', 'AccountController@index');
//        Route::get('/account/change-account/{id}', 'AccountController@changeAccount');
    }
);
