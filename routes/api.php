<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'user'], function () {
    Route::group(['as' => 'user'], function () {
        Route::post('authenticate','User\UserController@authenticate');
        Route::delete('{id}','User\UserController@destroy')->name('.destroy');
    });
});

Route::group(['prefix' => 'product'], function () {
    Route::group(['as' => 'product'], function () {
        Route::delete('{id}', 'Product\ProductController@destroy')->name('.destroy');
        Route::get('', 'Product\ProductController@indexApi');
    });
});


Route::group(['prefix' => 'sale'], function () {
    Route::group(['as' => 'sale'], function () {
        Route::post('', 'Sale\SaleController@updateStatus');
    });
});
