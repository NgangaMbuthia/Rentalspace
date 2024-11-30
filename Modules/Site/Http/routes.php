<?php

Route::group(['middleware' => 'web', 'prefix' => 'application', 'namespace' => 'Modules\Site\Http\Controllers'], function()
{
    Route::get('/', 'SiteController@index');
    Route::any('/grid_view','SiteController@grid_view');
    Route::get('/property/details/{id}','SiteController@view_details');
    Route::get('/terms&Conditions','SiteController@terms');
    Route::any('/patners','PatnerRegController@create');
    Route::any('/fetch/category/{id}','SiteController@getCategories');
    Route::any('/property/search','SiteController@search');
    Route::any('/land/search','SiteController@searchLand');
    Route::any('/service-provider/details/{id}','SiteController@ViewProvider');
});
