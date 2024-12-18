<?php

Route::group(['middleware' => 'web', 'prefix' => 'security', 'namespace' => 'Modules\Gate\Http\Controllers'], function()
{
    Route::get('/', 'GateController@index');
    Route::get('/gate/index','GateController@getGates');
    Route::any('/gates/fetch_gates','GateController@fetchGates');
    Route::any('/gate/create','GateController@create');
    Route::any('/gate/update/{id}','GateController@Update');
    Route::any('/guard/index','GuardsController@index');
    Route::any('/guards/create','GuardsController@create');
    Route::any('/guards/fetch_guards','GuardsController@fetchGuards');
    Route::any('/guards/update/{id}','GuardsController@updateGuardDetails');
    Route::any('guards/assign','GuardsController@assignments');
    Route::get('/guards/assignments','GuardsController@getAssignments');
    Route::any('/find/gates/{property}','GuardsController@getPropertyGates');
    Route::any('/find/guards/{gate}','GuardsController@findGaurds');
    Route::any('/assignments/fetch_assigns','GuardsController@fetchAllAssignments');
    Route::any('/visitor/create','GateVisitorController@create');
    Route::any('/user/get_telephone/{id}','GateVisitorController@getTelephone');
    Route::any('/user/get_visitor_details/{id}','GateVisitorController@fetVisitorDetails');
    Route::get('/visitor/checkout','GateVisitorController@getVisitorlist');
    Route::any('/gates/fetch_visitors','GateVisitorController@fetchVisirors');
    Route::any('/gate/checkout/{id}','GateVisitorController@getCheckOutDetails');
    Route::get('/visitors/view/index','GateVisitorController@fetchVisitorsList');
    Route::any('/gates/view/fetch_visitors/{status}','GateVisitorController@viewVisitorsList');
    Route::any('/visitors/advanced/search','GateVisitorController@advancedSearch');
    Route::get('/visitors/vehicles/index','GateVisitorController@vihicles');
    Route::any('/gates/fetchvisitors/vehicles','GateVisitorController@fetch_vehicles');
    Route::get('/visitors/electronics/index','GateVisitorController@electronics');
    Route::any('/gates/fetchvisitors/electronics','GateVisitorController@fetch_electronics');
    Route::get('/visitors/statistics/tabulated','GateVisitorController@getTableStatistics');
    Route::get('/visitors/statistics/graphical','GateVisitorController@getGraphicalStats');
    Route::get('/statistics/graph/{year}/{property}','GateVisitorController@fetchGraphData');
    Route::any('/assignments/fetch_assignments','GuardsController@getCurrentAssingments');
    Route::any('/visitor/statistics','GateVisitorController@getStatistics');
    Route::any('/incident/report','GateController@CreateIncidents');
    Route::get('/incident/list/index','GateController@getIncidents');
    Route::any('/gate/fetch_incidents/{type}','GateController@fetchIncidenst');
    Route::any('/incident/description/{id}','GateController@getIncidentDescription');
    Route::get('/view/reports/visitors/index','GateController@getVisitorsReports');
    Route::any('/gates/fetch_visitors_reports/{type}','GateVisitorController@fetchVisitorReports');
});
