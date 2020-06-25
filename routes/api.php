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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get("salesload/data",'SaleLoadController@data');

Route::get("sales/data", 'SalesController@data');
Route::get("sales/remove", 'SalesController@remove');
Route::get("sales/allremove", 'SalesController@allremove');
Route::get("sales/confirm", 'SalesController@confirm');
Route::get("salesqualtity/data",'SaleQualityController@data');

//TRANSFER
Route::get("t-salesload/data",'SaleLoadController@t_data');
Route::get("t-sales/data", 'TransferController@data');
Route::get("t-sales/remove", 'TransferController@remove');
Route::get("t-sales/allremove", 'TransferController@allremove');
Route::get("t-sales/confirm", 'TransferController@confirm');
Route::get("t-salesqualtity/data",'SaleQualityController@tsq_data');

Route::post('barcode', 'BarcodeController@barcode');

