<?php

use App\Http\Controllers\LocaleController;
// use App\Http\Controllers\ExampleController;
/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    includeRouteFiles(__DIR__.'/backend/');
});

// Route::get('/hello-world/', function(){


Route::prefix('product')->group(function () {
	Route::get('/', 'App\Http\Controllers\ProductController@index');
	
	Route::get('/create', 'App\Http\Controllers\ProductController@create');
	Route::post('/', 'App\Http\Controllers\ProductController@store');
	
	Route::get('/{product_id}/edit', 'App\Http\Controllers\ProductController@edit');	
	Route::put('/{product_id}', 'App\Http\Controllers\ProductController@update');
	
	Route::get('/{product_id}/delete', 'App\Http\Controllers\ProductController@destroy');	
});
