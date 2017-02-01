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

Route::auth();

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
            Route::resource('sales', 'DiscountSalesController');
            Route::put('sales/{id}/sell', 'DiscountSalesController@sell')->name('admin.sales.sell');
//            Route::resource('sales', 'GoodsSalesController');

//            Route::post('sales/time/update', 'GoodsSalesController@timeUpdate');
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

//Route::group(['namespace' => 'Home'], function () {
//    Route::group(['middleware' => ['home.auth']], function () {
//        Route::get('/user', 'UserController@index')->name('home.user.index');
//    });
//});

/**
 * Wap group
 */
Route::group(['namespace' => 'Home'], function () {
    Route::get('/', 'IndexController@index')->name('home.index');
    Route::get('/goods/{id}', 'IndexController@goods')->name('home.goods.show');
    Route::get('/cart', 'CartController@index');
    Route::post('/login/code', 'AuthController@code')->name('home.login.code');
    Route::post('/login', 'AuthController@login')->name('home.login');
    Route::get('/login', 'AuthController@showLoginForm')->name('home.login')->middleware(['home.guest']);;
    Route::group(['middleware' => ['home.auth']], function () {
        Route::get('/user', 'UserController@index')->name('home.user.index');
        Route::post('/cart', 'CartController@store')->name('home.cart.store');
        Route::get('/cart', 'CartController@index')->name('home.cart.index');
        Route::put('/cart/add', 'CartController@add')->name('home.cart.add');
        Route::put('/cart/subtract', 'CartController@subtract')->name('home.cart.subtract');
        Route::delete('/cart/{id}', 'CartController@destroy')->name('home.cart.destroy');
        Route::post('/order', 'OrderController@store')->name('home.order.store');
        Route::get('/order', 'OrderController@index')->name('home.order.index');
        Route::get('/order/{sn}', 'OrderController@show')->name('home.order.show');
        Route::delete('/order/{sn}', 'OrderController@cancel')->name('home.order.cancel');
        Route::get('/order/success/{sn}', 'OrderController@success')->name('home.order.success');
        Route::get('/address', 'AddressController@index')->name('home.address.index');
//        Route::get('/address/{id}', 'AddressController@edit')->name('home.address.edit');
        Route::post('/address', 'AddressController@store')->name('home.address.store');
        Route::put('/address/{id}', 'AddressController@update')->name('home.address.update');
    });
//    Route::get('/oauth', 'WechatController@oauth');
//    Route::group(['middleware' => ['home.auth']], function () {
//        Route::resource('user', 'UserController');
//    });
});
Route::get('/test', function () {
    return view('admin.test');
});

