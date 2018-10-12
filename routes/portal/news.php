<?php
Route::resource('news', 'NewsController', ['except' => ['destroy', 'update', 'show']]);
Route::get('news/delete', 'NewsController@destroy')->name('news.delete');
Route::get('news/view/{id}', 'NewsController@view')->name('news.view');
Route::get('news/update/{id}', 'NewsController@update')->name('news.update');
