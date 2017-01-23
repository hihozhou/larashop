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


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
    ],
    function () {
        Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'LoginController@login');
        Route::get('logout', 'LoginController@logout')->name('admin.logout');

        /*
        |--------------------------------------------------------------------------
        | Dashboard Routes
        |--------------------------------------------------------------------------
        */
        Route::group(['middleware' => ['admin.auth']], function () {
            Route::get('/', 'GoodsSkuController@index');
            Route::resource('sku', 'GoodsSkuController');
            Route::resource('goods', 'GoodsController');
            Route::put('goods/{id}/sell', 'GoodsController@sellChange');
            Route::post('/upload', 'UploadController@store');
            Route::resource('sales', 'GoodsSalesController');
            Route::put('sales/{id}/sell', 'GoodsSalesController@sellChange');
            Route::post('sales/time/update', 'GoodsSalesController@timeUpdate');
//            Route::get('{router?}', function ($router = null) {
////                echo "123";exit;
//////                var_dump($router);
//////                echo $router;exit;
//                return view('admin.index');
//            })->where('router', '[\/\w\.-]*');
//            Route::get('/', 'IndexController@index');
//            Route::get('/index', 'IndexController@index');

            // ...
        });
//        Route::get('/account', 'AccountController@index');
//        Route::get('/account/change-account/{id}', 'AccountController@changeAccount');
    }
);

/**
 * Wap group
 */
Route::group(['namespace' => 'Shop'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/goods/{id}', 'IndexController@goods');
    Route::get('/cart', 'CartController@index');
    Route::post('/login/code', 'AuthController@code')->name('shop.login.code');
    Route::post('/login', 'AuthController@login')->name('shop.login');
    Route::group(['middleware' => ['home.auth']], function () {
        Route::post('/cart', 'CartController@store')->name('shop.cart.store');
        Route::get('/cart', 'CartController@index')->name('shop.cart.index');
        Route::put('/cart/add', 'CartController@add')->name('shop.cart.add');
        Route::put('/cart/subtract', 'CartController@subtract')->name('shop.cart.subtract');
        Route::delete('/cart/{id}', 'CartController@destroy')->name('shop.cart.destroy');
    });
//    Route::get('/oauth', 'WechatController@oauth');
//    Route::group(['middleware' => ['home.auth']], function () {
//        Route::resource('user', 'UserController');
//    });
});
Route::get('/test', function () {
    return view('admin.test');
});

