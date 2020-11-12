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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/listmakanan', 'MakananController@index')->name('makanan.list');
Route::post('/listmakanan', 'MakananController@create')->name('makanan.tambah');

//edit
Route::match(['get', 'post'], '/edit/{id}', 'MakananController@edit');


//hapus
Route::delete('/delete/{id}', 'MakananController@delete')->name('makanan.delete');