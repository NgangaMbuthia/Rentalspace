<?php

Route::group(['middleware' => 'web', 'prefix' => 'tenants', 'namespace' => 'Modules\Tenants\Http\Controllers'], function()
{
    Route::get('/', 'TenantsController@index');
    Route::get('/statistics/{year}','TenantsController@getPaymentHistory');
    Route::get('/list/spaces','TenantsController@getSpace');
    Route::get('/spaces/fetch_spaces/{status}','TenantsController@fetchSpaceHistory');
    Route::get('/invoices/index','TenantsController@getInvoices');
    Route::get('/invoices/fetch_invoices/{status}','TenantsController@fetchInvoices');
    Route::get('/payment/history','TenantsController@gettransactions');
    Route::any('/transactions/fetch_transactions','TenantsController@fetchAllTransactions');
    Route::get('/payment/deductions','TenantsController@getDeductions');
    Route::any('/payments/fetch_credit_payments','TenantsController@fetchDeductions');
    Route::get('/payment/additions','TenantsController@getAdditions');
    Route::any('/payments/fetch_debit_payments','TenantsController@fetchDebits');
    Route::get('/registed/items','TenantsController@getRegisteredItems');
    Route::any('/tenants/fetch_assets/{status}','TenantsController@fetchAssets');
    Route::get('/repairs/index','TenantsController@getRepairs');
    Route::any('/repairs/fetch_repairs','TenantsController@fetchRepairs');
    Route::any('/repair/create_request','TenantsController@createRequest');
    Route::get('/repair/request/index','TenantsController@viewRepairRequests');
    Route::any('/repairs/fetch_repair_requests/{status}','TenantsController@getRequestForRepairs');
    Route::any('/repairs/my_repairs','TenantsController@ftechMyRequests');
    Route::any('/invoice/payment','PaymentController@create');
    Route::any('/invoice/GetInvoiceAmount/{id}','TenantsController@GetInvoiceAmount');
    Route::any('/fetch/spaceInvoice/{id}','TenantsController@getSpaceInvoices');
    Route::any('/payment/submitted','TenantsController@getSubmittedPayments');
    Route::any('/payments/fetch_submitted_payments','PaymentController@fetchSubmitted');
    Route::any('/submitted_payements/details/{id}','PaymentController@viewDetails');
    Route::any('/utility-bills/index','UtilityController@index');
    Route::any('/utility-bills/statistics','UtilityController@getStatistics');
    Route::any('/payment/monthly-summary','PaymentController@getMontlySummary');
    


   
});
