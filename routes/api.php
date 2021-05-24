<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::resource('/product', 'ProductController')->only([
//     'index', 'show', 'store', 'update', 'destroy'
// ]);

Route::get('/product', 'ProductController@index');
Route::get('/product/{optionId}', 'ProductController@show');
Route::post('/product', 'ProductController@store');
Route::put('/product/{optionId}', 'ProductController@update');
Route::delete('/product/{optionId}', 'ProductController@destroy');

Route::get('/category', function () {
    return App\Models\Category::all();
});

Route::get('/unit', function () {
    return App\Models\Unit::all();
});

Route::get('/zone', function () {
    return App\Models\Zone::all();
});