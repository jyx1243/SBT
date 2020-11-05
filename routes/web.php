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

Route::get('/{path}', function () {
    return view('app');
})->where('path', '.*');

// Route::get('/', 'IndexController@index')->name('index');

// // 商品列表
// Route::get('/products', 'ProductController@index')->name('product.index');
// Route::get('/products/option-{option}', 'ProductController@show')->name('product.show');

// // 清單
// Route::get('/list', 'ListController@index')->name('list.index');
// Route::post('/list/option-{option}', 'ListController@add')->name('list.add');
// Route::put('/list/option-{option}', 'ListController@updata')->name('list.update');
// Route::delete('/list/option-{option}', 'ListController@delete')->name('list.delete');
// Route::delete('/list', 'ListController@deleteAll')->name('list.deleteAll');

// // 登入頁面
// Route::get('/login', function () {
//     return view('login');
// })->name('login.index');

// // 登入
// Route::post('/login', 'Auth\LoginController@login')->name('login');

// // 管理頁面
// Route::middleware(['auth'])->group(function () {
//     // 登出
//     Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

//     // 新增商品
//     Route::get('/products/create', 'ProductController@create')->name('product.create');
//     Route::post('/products', 'ProductController@store')->name('product.store');

//     // 修改商品
//     Route::get('/products/option-{option}/edit', 'ProductController@edit')->name('product.edit');
//     Route::put('/products/option-{option}', 'ProductController@update')->name('product.update');

//     // 刪除商品
//     Route::delete('/products/option-{option}', 'ProductController@destroy')->name('product.destroy');

//     // 新增分項
//     Route::get('/products/product-{product}/create', 'ProductController@createOption')->name('product.createOption');
//     Route::post('/products/product-{product}', 'ProductController@storeOption')->name('product.storeOption');

//     // 管理價格
//     Route::post('/products/option-{option}/price', 'PriceController@store')->name('price.store');
//     Route::delete('/products/option-{option}/price-{price}', 'PriceController@destroy')->name('price.destroy');

//     // 管理優惠
//     Route::post('/products/option-{option}/price-{price}/sale', 'SaleController@store')->name('sale.store');
//     Route::delete('/products/option-{option}/price-{price}/sale-{sale}', 'SaleController@destroy')->name('sale.destroy');

//     // 管理位置
//     Route::post('/products/option-{option}/location', 'LocationController@store')->name('location.store');
//     Route::delete('/products/option-{option}/location-{location}', 'LocationController@destroy')->name('location.destroy');
// });
