<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\Makanan;
use App\Minuman;
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
    $makanan = Makanan::get();
    $orders = Order::get();
    $minuman = Minuman::get();

    return view('order.list', ['orders' => $orders, 'makanan' => $makanan, 'minuman' => $minuman] );
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//list makanan
Route::get('/listmakanan', 'MakananController@index')->middleware('auth')->name('makanan.list');
Route::post('/listmakanan', 'MakananController@create')->name('makanan.tambah');
Route::post('/listminuman', 'MinumanController@create')->name('minuman.tambah');

//edit makanan
Route::match(['get', 'post'], '/edit/{id}', 'MakananController@edit');
Route::match(['get', 'post'], '/editminum/{id}', 'MinumanController@edit');

//hapus makanan
Route::delete('/delete/{id}', 'MakananController@delete')->name('makanan.delete');
Route::delete('/deleteminum/{id}', 'MinumanController@delete')->name('makanan.delete');

//list order
Route::get('/listorder', 'OrderController@index')->name('order.list');
Route::post('/listorder', 'OrderController@create')->name('order.tambah');
Route::get('/bayar/{id}', 'OrderController@bayar')->name('order.bayar');
Route::post('/totalorder/{id}', 'OrderController@total')->name('order.total');

Route::get('/riwayatorder', 'OrderController@riwayat')->name('order.riwayat');

Route::get('/admin/listorder', 'OrderController@admin')->middleware('auth')->name('order.admin');
Route::delete('/deleteorder/{id}', 'OrderController@delete')->name('order.delete');
Route::post('/completeorder/{id}', 'OrderController@complete')->name('order.complete');