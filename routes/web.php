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

Route::get('/product/searchjson',['as' => 'product.searchjson','uses' => 'InventoryProductController@searchjson']);

Route::resource('stock','InventoryStockController');
Route::resource('product','InventoryProductController');
Route::resource('unit','InventoryUnitController');
Route::resource('kategori','InventoryCategoriController');
Route::resource('location','InventoryLocationController');

