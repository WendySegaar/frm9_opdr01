<?php


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/albums', 'AlbumController@index')->name('albums');
Route::get('/albums/create', 'AlbumController@create')->name('create_album');
Route::post('/albums', 'AlbumController@store')->name('store_album');
Route::get('/albums/{album}', 'AlbumController@show')->name('show_album');
Route::get('/albums/{album}/edit', 'AlbumController@edit')->name('edit_album');
Route::post('/albums/{album}', 'AlbumController@update')->name('update_album');
Route::delete('/albums/{album}', 'AlbumController@destroy')->name('delete_album');

Route::get('/album/{album}/photos/create', 'PhotoController@create')->name('create_photo');
Route::post('/photos', 'PhotoController@store')->name('store_photo');
Route::get('/photos/{photo}/edit', 'PhotoController@edit')->name('edit_photo');
Route::post('/photos/{photo}', 'PhotoController@update')->name('update_photo');
Route::delete('/photos/{photo}', 'PhotoController@destroy')->name('delete_photo');

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');
