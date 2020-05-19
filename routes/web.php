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

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('order.index');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', function () {
    return redirect()->route('order.index');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('order', 'OrderController');
    Route::resource('supply', 'SupplyController');
    Route::post('/address/{type}', 'AddressController@getData')->name('address');
});
