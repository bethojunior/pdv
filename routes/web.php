<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['prefix' => 'home'], function () {
    Route::group(['as' => 'home'], function () {
        Route::get('', 'Home\HomeController@index')->name('.home');
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::group(['as' => 'user'], function () {
        Route::get('', 'User\UserController@index')->name('.list');
        Route::post('insert','User\UserController@insert')->name('.insert');
    });
});

Route::group(['prefix' => 'products'], function () {
    Route::group(['as' => 'products'], function () {
        Route::get('', 'Product\ProductController@index')->name('.list');
        Route::post('', 'Product\ProductController@create')->name('.create');
    });
});

Route::group(['prefix' => 'typeProduct'], function () {
    Route::group(['as' => 'typeProduct'], function () {
        Route::get('', 'ProductType\ProductTypeController@index')->name('.index');
        Route::post('', 'ProductType\ProductTypeController@create')->name('.create');
    });
});


