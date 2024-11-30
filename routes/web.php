<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect('/application');
});
Route::get('logout', 'LogOutController@logout');
Auth::routes();
Route::get('/home', 'HomeController@index');
Route::get('/property/add', 'HomeController@addProperty');

Route::group(['middleware' => 'web'], function()
{

});



Auth::routes();

Route::get('images/{image}', function($image = null)
{
	 
    $path = storage_path().'/' . $image;

    if (file_exists($path)) { 
        return Response::download($path);
    }
});


Route::any('/login','Auth\LoginController@login');

Route::get('/home', 'HomeController@index');
Route::get('/get_tenants/payment/{year}','HomeController@paymentstatistics');
Route::get('/get_payment/statistics','HomeController@paymentMethosStats');
Route::get('/account/settings','HomeController@settings');
Route::post('/provider/update/{id}','HomeController@settings');
Route::get('message/sent/items','MessageController@index');
Route::any('messages/sent/fetch_all','MessageController@fetchSent');
Route::get('/get_invoices/status/statistics','HomeController@getInvoivesStatitsics');
Route::get('/send/invoices/index','HomeController@sendInvoices');
Route::get('/send/payment-reminder/index','HomeController@sendPaymentReminder');
Route::any('/account/sms_settings','SmsController@saveSmsOption');
Route::any('/account/email_settings','SmsController@saveEmailOption');
Route::any('account/invoice_settings','SmsController@invoiceOption');
Route::any('/account/utility_settings','SmsController@utilitySettings');
Route::any('/connecttoEquity','HomeController@getOpenningBalance');
Route::any('/Property/paymentStatistics','HomeController@getPaymentStaticstsic');
Route::any('/payments/getDailyPayment','HomeController@getDailyPayment');

