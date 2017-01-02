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
    Route::get('/skus', 'GoodsSkuController@index');
    Route::post('/skus/create', 'GoodsSkuController@store');
    Route::delete('/skus/{id}', 'GoodsSkuController@destroy');
    Route::get('/skus/{id}', 'GoodsSkuController@show');
    Route::patch('/skus/{id}', 'GoodsSkuController@update');
//    Route::get('/oauth', 'WechatController@oauth');
//    Route::group(['middleware' => ['home.auth']], function () {
//        Route::resource('user', 'UserController');
//    });
});