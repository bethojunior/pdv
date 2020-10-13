<?php

Route::group(['prefix' => 'user'], function () {
    Route::group(['as' => 'user'], function () {
        Route::post('authenticate','App\AppController@updateApps');
    });
});
