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

//Route::resource('product', 'ProductController');
Route::get('products', 'ProductController@index')->name('product.index');
Route::get('products/create', 'ProductController@create')->name('product.create');
Route::post('products', 'ProductController@store')->name('product.store');
Route::get('products/option-{option}', 'ProductController@show')->name('product.show');
Route::get('products/option-{option}/edit', 'ProductController@edit')->name('product.edit');
Route::put('products/option-{option}', 'ProductController@update')->name('product.update');
Route::delete('products/option-{option}', 'ProductController@destroy')->name('product.destroy');

Route::get('products/product-{product}/create', 'ProductController@createOption')->name('product.createOption');
Route::post('products/product-{product}', 'ProductController@storeOption')->name('product.storeOption');

Route::post('products/option-{option}/price', 'PriceController@store')->name('price.store');
Route::delete('products/option-{option}/price-{price}', 'PriceController@destroy')->name('price.destroy');

Route::post('products/option-{option}/price-{price}/sale', 'SaleController@store')->name('sale.store');
Route::delete('products/option-{option}/price-{price}/sale-{sale}', 'SaleController@destroy')->name('sale.destroy');

Route::post('products/option-{option}/location', 'LocationController@store')->name('location.store');
Route::delete('products/option-{option}/location-{location}', 'LocationController@destroy')->name('location.destroy');