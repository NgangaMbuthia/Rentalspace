<?php

Route::group(['middleware' => 'web', 'prefix' => 'serviceproviders', 'namespace' => 'Modules\ServiceProviders\Http\Controllers'], function()
{
    Route::get('/', 'ServiceProvidersController@index');
     Route::get('/job/requests', 'JobController@index');
     Route::get('/jobs/fetch_job_requests/{status}','JobController@fetchJobRequests');
     Route::any('/job/response/{action}/{id}','JobController@closejobRequests');
     Route::any('/job/cancel_response/{id}','JobController@cancelJob');
     Route::get('/providers/index','ServiceProvidersController@provodersList');
     Route::any('/providers/fetch_providers','ServiceProvidersController@fetchProviders');
     Route::post('provider/store','ServiceProvidersController@editDetails');
     Route::get('//profile/update','ServiceProvidersController@updateDetails');
     Route::get('/home','ServiceProvidersController@home');
     Route::any('/providers/approve/{id}','ServiceProvidersController@approveProvider');
     Route::any('/providers/other/{action}/{id}','ServiceProvidersController@otherActions');
     Route::any('/job_requests/create/{id}','ServiceProvidersController@CreateJobRequest');

});
