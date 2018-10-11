<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name("dashboard");

Route::resource('category', 'CategoryController', ['except' => ['destroy','show','update']]);
Route::get('/delete', 'CategoryController@destroy')->name('category.delete'); //delete request
Route::get('/update/{id}', 'CategoryController@update')->name('category.update');

Route::resource('news', 'CategoryController');

