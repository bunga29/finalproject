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

//list makanan
Route::get('/listmakanan', 'MakananController@index')->middleware('auth')->name('makanan.list');
Route::post('/listmakanan', 'MakananController@create')->name('makanan.tambah');

//edit makanan
Route::match(['get', 'post'], '/edit/{id}', 'MakananController@edit');

//hapus makanan
Route::delete('/delete/{id}', 'MakananController@delete')->name('makanan.delete');


//list order
Route::get('/listorder', 'OrderController@index')->name('order.list');
Route::post('/listorder', 'OrderController@create')->name('order.tambah');
Route::get('/bayar/{id}', 'OrderController@bayar')->name('order.bayar');

Route::get('/admin/listorder', 'OrderController@admin')->middleware('auth')->name('order.admin');
Route::delete('/deleteorder/{id}', 'OrderController@delete')->name('order.delete');
Route::delete('/deleteeorder/{id}', 'OrderController@deletee')->name('order.deletee');