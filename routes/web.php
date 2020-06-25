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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'HomeController@kitchenvenus');
Route::post('/loadmore/load_data', 'KitchenVenusController@load_data')->name('loadmore.load_data');
Route::get('/kvDetail/{id?}', 'KitchenVenusController@kvDetail')->name('kvDetail');

Route::get('cat/{id}', 'HomeController@category')->name('cat');
Route::get('about', 'HomeController@about')->name('about');
Route::get('contact', 'HomeController@contact')->name('contact');
Route::get('search', 'HomeController@search')->name('search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('categories','CategoriesController');
    Route::resource('products','ProductController');
    Route::get('detail/{id?}', 'ProductController@detail')->name('detail');
    Route::resource('purchase','PurchaseController');
    Route::resource('mainBox','MainBoxController');
    Route::resource('sales','SalesController');
    //stockadd
    Route::get('stock-add', 'StockAddController@index')->name('stock-add');
    Route::get('stock-add-search', 'StockAddController@search')->name('stock-add-search');
    Route::post('stock-add-store', 'StockAddController@store')->name('stock-add-store');
    Route::delete('stock-add-delete/{id}', 'StockAddController@destroy')->name('stock-add-delete');
    
    //warehouse
    Route::get('warehouse', 'WareHouseController@index')->name('warehouse');
    Route::get('warehouse-getqty', 'WareHouseController@qty')->name('warehouse-getqty');
    Route::get('warehouse-search', 'WareHouseController@search')->name('warehouse-search');
    Route::post('warehouse-store', 'WareHouseController@store')->name('warehouse-store');
    Route::delete('warehouse-delete/{id}', 'WareHouseController@destroy')->name('warehouse-delete');
    //export
    Route::get('stock-export', 'StockExportController@index')->name('stock-export');
    Route::get('stock-export-search', 'StockExportController@search')->name('stock-export-search');
    Route::post('stock-export-store', 'StockExportController@store')->name('stock-export-store');
    Route::delete('stock-export-delete/{id}', 'StockExportController@destroy')->name('stock-export-delete');
    
    //stockadd
    Route::get('warehouse', 'WareHouseController@index')->name('warehouse');
    Route::get('warehouse-search', 'WareHouseController@search')->name('warehouse-search');
    Route::post('warehouse-store', 'WareHouseController@store')->name('warehouse-store');
    Route::delete('warehouse-delete/{id}', 'WareHouseController@destroy')->name('warehouse-delete');

    //stock check
    Route::get('search-stock-check', 'StockCheckController@search')->name('search-stock-check');
    Route::get('stock-check', 'StockCheckController@index')->name('stock-check');
    Route::post('stock-check-create', 'StockCheckController@store')->name('stock-check-create');
    Route::patch('/stock-check-update/{id}', 'StockCheckController@update')->name('stock-check-update');


    Route::get('saleDetail/{id}', 'SaleReportController@saleDetail')->name('saleDetail');
    Route::get('t_Detail/{id}', 'SaleReportController@t_Detail')->name('t_Detail');

    Route::get('purchase_report', 'PurchaseController@report')->name('purchase_report');
    Route::get('purchase_search', 'PurchaseController@search')->name('purchase_search');

    Route::get('pur_search', 'PurchaseController@pur_search')->name('pur_search');

    Route::get('local_shop','MainBoxController@local')->name('local_shop');

//    Route::get('mainbox_barcode','MainBoxController@mainbox_barcode')->name('mainbox_barcode');;

    Route::get('online_shop','MainBoxController@online')->name('online_shop');
    Route::post('w_status','MainBoxController@status')->name('w_status');
//    Report
    Route::get('sale_report', 'SaleReportController@saleReport')->name('saleReport');
    Route::get('saleReportSearch', 'SaleReportController@search')->name('saleReportSearch');

    Route::get('t_report', 'SaleReportController@t_Report')->name('t_report');
    Route::get('t_ReportSearch', 'SaleReportController@t_search')->name('t_ReportSearch');

    //Pawn Shop
    Route::get('pawn', 'PawnController@index')->name('pawn');
    Route::post('pawnform', 'PawnController@pawn')->name('pawnform');
    Route::get('yawe', 'PawnController@yawe')->name('yawe');

    Route::post('pawn_edit/{id}', 'PawnController@pawn_edit')->name('pawn_edit');
    Route::post('yawe_edit/{id}', 'PawnController@edit')->name('yawe_edit');

    Route::post('yawe_update/{id}', 'PawnController@yawe_update')->name('yawe_update');
    Route::post('costs', 'PawnController@costs')->name('costs');
    Route::get('pawn_report', 'PawnController@pawn_report')->name('pawn_report');
    Route::get('yawe_report', 'PawnController@yawe_report')->name('yawe_report');
    Route::get('py_search', 'PawnController@py_search')->name('py_search');
    Route::get('cost_index', 'PawnController@cost_index')->name('cost_index');
    Route::get('p_search', 'PawnController@p_search')->name('p_search');
    Route::get('y_search', 'PawnController@y_search')->name('y_search');
    Route::get('c_search', 'PawnController@c_search')->name('c_search');
    Route::get('bank', 'PawnController@bank')->name('bank');
    Route::post('bankedit', 'PawnController@bankedit')->name('bankedit');
    Route::get('searchall', 'PawnController@searchall')->name('searchall');
    // pawn Shop End


    //Excel
    Route::get('pawn_excel', 'PawnController@pawn_excel')->name('pawn_excel');
    Route::get('yawe_excel', 'PawnController@yawe_excel')->name('yawe_excel');
    Route::get('expense_excel', 'PawnController@expense_excel')->name('expense_excel');
    
    //Townships
    Route::get('townships', 'TownshipController@index')->name('townships');
    Route::post('t_store', 'TownshipController@store')->name('t_store');
    Route::get('t_delete/{id}', 'TownshipController@destroy')->name('t_delete');


    //dailytotal
    Route::get('dailytotal', 'SaleReportController@dailytotal')->name('dailytotal');

    //transfer
    Route::get('transfer', 'TransferController@index')->name('transfer');
    Route::get('t_dailytotal', 'SaleReportController@t_dailytotal')->name('t_dailytotal');

    // import Product
    Route::get('aladdin_product', 'AladdinProductController@getIndex')->name('aladdin_product');
    Route::get('sync_product', 'AladdinProductController@index')->name('sync_product');
    Route::post('update_products', 'AladdinProductController@updateProducts')->name('updateProducts');

});

Route::get('barcode', 'SaleReportController@barcode')->name('barcode');
Route::get('mainbox_barcode', 'SaleReportController@mainbox_barcode')->name('mainbox_barcode');
Route::get('barcodegenerate', 'SaleReportController@barcodegenerate')->name('barcodegenerate');
Route::get('one_barcode_generate/{id}', 'SaleReportController@oneBarcodeGenerate')->name('oneBarcodeGenerate');

Route::post('confirm', 'SalesController@confirm')->name('confirm');
Route::post('t_confirm', 'TransferController@confirm')->name('t_confirm');




