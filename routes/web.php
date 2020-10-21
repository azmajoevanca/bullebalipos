<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', function() {
    return redirect(route('login'));
    Route::resource('/register', 'RegisterContoller');        
});

Auth::routes();
Route::group(['middleware' => 'auth'], function() {
    Route::get('home', 'HomeController@index')->name('home');   
    Route::resource('/kategori', 'CategoryController')->except([
        'create', 'show'
    ]);
    Route::resource('produk', 'ProductController');
    Route::resource('customers', 'customerController');
    Route::resource('order', 'orderController');
    Route::resource('coba', 'orderController');
    Route::post('/order/calculate', 'orderController@calculate');
    Route::post('/order/process', 'orderController@process');
    Route::get('/return', 'returnController@index')->name('return.index');
    Route::get('/return/{code}', 'returnController@show')->name('return.show');
    Route::post('/return/store', 'returnController@store');

});
Route::get('/pesan/sukses','NotifController@sukses');
Route::get('/pesan/gagal','NotifController@gagal');

