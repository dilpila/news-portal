<?php
Route::resource('category', 'CategoryController', ['except' => ['destroy','show','update']]);
Route::get('category/delete', 'CategoryController@destroy')->name('category.delete'); //delete request
Route::get('category/update/{id}', 'CategoryController@update')->name('category.update');
