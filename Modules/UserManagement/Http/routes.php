<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\UserManagement\Http\Controllers'], function()
{
	Route::get('/', 'UserManagementController@index');
	Route::any('/role/addrole','UserManagementController@create_role');
	Route::any('/role/store','UserManagementController@store');
	Route::any('/role/index','UserManagementController@index');
	Route::post('/role/update/{id}','UserManagementController@update');
	Route::get('/role/edit/{id}','UserManagementController@edit');
	Route::get('/user/adduser','UserController@add_user');
	Route::post('/user/store','UserController@store');
	Route::any('/user/viewuser','UserController@index');
	Route::get('/user/update/{id}','UserController@edit');
	Route::post('/user/edit/{id}','UserController@update');
	Route::any('/profile/index','UserManagementController@viewprofile');
	Route::any('/user/view/{id}','UserController@view');
	Route::any('user/updateprofileimage', 'UserManagementController@upload');
	Route::any('/user/fetch_users','UserController@fetch_users');
	Route::get('/role/fetch_roles','UserManagementController@fetch_roles');
	Route::get('/role/userstatistics/{year}','UserController@get_statistics');
	Route::get('/user/{action}/{id}','UserController@block_user');
	Route::get('/profile/update','UserController@update_profile');
	Route::post('/profile/store','UserController@update_profile_store');
	Route::any('/system/fetch_users','UserController@fetch_users');
	Route::any('/system/fetch_roles','UserManagementController@fetch_roles');
	Route::any('/system/fetch_modules','UserController@fetchModules');
	Route::any('/roles/edit/{id}','UserManagementController@editRole');
	
});