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
Route::get('category/delete', 'CategoryController@destroy')->name('category.delete'); //delete request
Route::get('category/update/{id}', 'CategoryController@update')->name('category.update');

Route::resource('news', 'NewsController',['except'=>['destroy','update','show']]);
Route::get('news/delete', 'NewsController@destroy')->name('news.delete');
Route::get('news/view/{id}', 'NewsController@view')->name('news.view');
Route::get('news/update/{id}', 'NewsController@update')->name('news.update');

