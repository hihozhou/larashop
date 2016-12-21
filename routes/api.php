<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/sku', 'GoodsSkuController@index');
    Route::post('/sku/create', 'GoodsSkuController@store');
    Route::delete('/sku/{id}', 'GoodsSkuController@destroy');
//    Route::get('/oauth', 'WechatController@oauth');
//    Route::group(['middleware' => ['home.auth']], function () {
//        Route::resource('user', 'UserController');
//    });
});