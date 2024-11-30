<?php

Route::group(['middleware' => 'web', 'prefix' => 'hotels', 'namespace' => 'Modules\Hotels\Http\Controllers'], function()
{
    Route::get('/', 'HotelsController@index');
    Route::get('/hotel/types','HotelsController@typeIndex');
    Route::any('/hotels/fetch_hotel_types','HotelsController@fetchHotelTypes');
  Route::any('/hotel_type/update/{id}','HotelsController@updateHotelTypes');
Route::any('/hotel-type/create','HotelsController@createHotelTypes');
Route::any('/hotel_type/delete/{id}','HotelsController@deleteHotelType');
Route::get('/supplier/index','HotelsController@suppliers');
Route::any('/hotels/fetch_suppliers','HotelsController@fetchSuppliers');
Route::any('/supplier/create','HotelsController@createSupplier');
Route::any('/supplier/update/{id}','HotelsController@updateSupplier');
Route::any('/suppler/suspend/{id}','HotelsController@suspendSupplier');
Route::any('/supplier/reject/{id}','HotelsController@rejectApplication');
Route::any('/suppler/approve/{id}','HotelsController@approveApplication');
Route::get('/rooms/room-types','HotelsController@roomTypes');
Route::any('/hotels/fetch_room_types','HotelsController@fetchRoomTypes');
Route::any('/room/type/create','HotelsController@createRoomType');
Route::any('/room_type/update/{id}','HotelsController@editHotel');
Route::any('/room_type/delete/{id}','HotelsController@deletRoomType');
Route::any('/room/bed-types','HotelsController@getBedTypes');
Route::any('/hotels/fetch_bed_types','HotelsController@fetchBedTypes');
Route::any('/bed_type/create','HotelsController@createBedType');
Route::any('/bed_type/update/{id}','HotelsController@editBedType');
Route::any('/bed_type/delete/{id}','HotelsController@deletBedType');
Route::get('/amentities/index','HotelsController@getAmentities');
Route::any('/hotels/fetch_supplier_amentities','HotelsController@fetchAmentities');
Route::any('/supplier_amentity/create','HotelsController@createSAmentity');
Route::any('/amentity/update/{id}','HotelsController@updateSAmetity');
Route::any('/amentity/delete/{id}','HotelsController@deleteAmentity');
Route::any('/hotel/create','HotelController@create');
Route::get('/hotel/index','HotelController@index');
Route::any('/hotels/fetch_hotels','HotelController@fetchHotels');
Route::any('/hotel/update/{id}','HotelController@updateHotel');
Route::any('/supplier/gallery','HotelController@Gallery');
Route::any('/hotel/delete/{id}','HotelController@DeleteHotel');
Route::any('/admin/hotels','HotelController@adminView');
Route::any('/hotels/fetch_admin_hotels','HotelController@fetchAllHotels');
Route::any('/hotel/profile/{id}','HotelController@CreateProfile');
Route::any('/hotel/update_profile','HotelController@CreateProfile');
Route::any('/room/create','RoomController@create');
Route::get('/rooms/index','RoomController@index');
Route::any('/rooms/fetch_rooms','RoomController@fetchRooms');
Route::get('/admin/rooms','RoomController@getAdminRooms');
Route::any('/hotels/fetch_admin_rooms','RoomController@fetchAdminRooms');
Route::any('/hotel/reports','HotelController@HotelsReport');
Route::any('/rooms/reports','RoomController@RoomReport');
Route::any('/amentities/reports','HotelsController@AmentitiesReports');
Route::any('/bed_types/reports','HotelsController@BedTypesReports');
Route::any('/roomtypes/reports','HotelsController@RoomTypeReports');
Route::any('/payment/{hotel}/{year}','HotelsController@getStatistics');
Route::any('/supplier/hotel/gallery','HotelController@getGallery');
Route::any('/admin/package-categories','PackageSettingsController@index');


});
