<?php

Route::group(['middleware' => 'web', 'prefix' => 'supplier', 'namespace' => 'Modules\Supplier\Http\Controllers'], function()
{
    Route::get('/', 'SupplierController@index');
    Route::any('/supplier/add_new','SupplierController@createNewSupplier');
    Route::get('/supplier/index','SupplierController@getSuppliers');
    Route::any('supplier/fetch_list','SupplierController@fetch_list');
    Route::any('/supplier/update/{id}','SupplierController@update');
    Route::any('/supplier/export','ReportController@index');
    Route::get('/supplier/list/{format}','ReportController@listreport');
    Route::get('supplier/view/{id}','SupplierController@show');
    Route::any('/supplier/fetch','SupplierController@getSupplierDetails');
    Route::any('quatation/create','QuatationController@create');
    Route::any('/supplier/product_supplier/{name}','SupplierController@getSupplierList');

});
