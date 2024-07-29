<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)
    ->group(function () {
        Route::get('', 'index')->name('home');
    });

Route::controller(ProductController::class)
    ->prefix('products')
    ->name('products.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('compare', 'compare')->name('compare');
        Route::get('{slug}', 'show')->name('show')->where(['slug' => '[a-z0-9-]+']);
    });


//Route::get('', 'index')->name('index'); // all objects
//Route::get('create', 'create')->name('create'); // prepare for create
//Route::post('', 'store')->name('store'); // save object
//Route::get('{id}', 'show')->name('show')->where(['id' => '[0-9]+']); // show object
//Route::get('{id}/edit', 'edit')->name('edit')->where(['id' => '[0-9]+']); // prepare for edit
//Route::put('{id}', 'update')->name('update')->where(['id' => '[0-9]+']); // update object
//Route::delete('{id}', 'destroy')->name('destroy')->where(['id' => '[0-9]+']); // delete object
