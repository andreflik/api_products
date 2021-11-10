<?php

use Illuminate\Http\Request;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('API')->name('api.')->group(function() {
    Route::prefix('/products')->group(function() {
        Route::get('/','ProductController@index')->name('index_products');
        Route::get('/{id}', 'ProductController@show')->name('single_products');

        Route::post('/', 'ProductController@store')->name('store_products');
        Route::put('/{id}', 'ProductController@update')->name('update_products');
        
        Route::delete('/{id}', 'ProductController@delete')->name('delete_products');

    });
});