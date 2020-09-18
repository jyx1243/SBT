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
    return view('index');
})->name('index');

Route::resource('product', 'ProductController');

Route::post('product/{option}/price', 'PriceController@store')->name('price.store');
Route::delete('product/{option}/price/{price}', 'PriceController@destroy')->name('price.destroy');

Route::post('product/{option}/price/{price}/sale', 'SaleController@store')->name('sale.store');
Route::delete('product/{option}/price/{price}/sale/{sale}', 'SaleController@destroy')->name('sale.destroy');

Route::post('product/{option}/location', 'LocationController@store')->name('location.store');
Route::delete('product/{option}/location/{location}', 'LocationController@destroy')->name('location.destroy');