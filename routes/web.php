<?php

/** Redirect to services */
Route::redirect('/', '/services');

/** Staff */
Route::get('/staff', 'StaffController@index')->name('staff.index');
Route::post('/staff', 'StaffController@store')->name('staff.store');

/** Services */
Route::get('/services', 'ServicesController@index')->name('services.index');
Route::get('/services/create', 'ServicesController@create')->name('services.create');
Route::post('/services', 'ServicesController@store')->name('services.store');
Route::get('/services/{service}', 'ServicesController@show')->name('services.show');
Route::get('/services/{service}/edit', 'ServicesController@edit')->name('services.edit');
Route::put('/services/{service}', 'ServicesController@update')->name('services.update');
Route::put('/services/{service}/reservice', 'ServicesController@reservice')->name('services.reservice');
Route::put('/services/{service}/complete', 'ServicesController@complete')->name('services.complete');
Route::put('/services/{service}/cancelDelivery', 'ServicesController@cancelDelivery')->name('services.cancelDelivery');
Route::put('/services/{service}/cancelPayment', 'ServicesController@cancelPayment')->name('services.cancelPayment');
Route::delete('/services/{service}', 'ServicesController@destroy')->name('services.destroy');

/** Agents */
Route::get('/agents', 'AgentsController@index')->name('agents.index');
Route::post('/agents', 'AgentsController@store')->name('agents.store');
Route::get('/agents/{agent}', 'AgentsController@show')->name('agents.show');
Route::get('/agents/{agent}/edit', 'AgentsController@edit')->name('agents.edit');
Route::put('/agents/{agent}', 'AgentsController@update')->name('agents.update');
Route::delete('/agents/{agent}', 'AgentsController@destroy')->name('agents.destroy');

/** Payments */
Route::get('/payments', 'PaymentsController@index')->name('payments.index');
Route::post('/payments/services/{service}', 'PaymentsController@store')->name('payments.store');

/** Deliveries */
Route::get('/deliveries', 'DeliveriesController@index')->name('deliveries.index');
Route::get('/deliveries/create', 'DeliveriesController@create')->name('deliveries.create');
Route::post('/deliveries', 'DeliveriesController@store')->name('deliveries.store');
Route::delete('/deliveries/{delivery}', 'DeliveriesController@destroy')->name('deliveries.destroy');

/** Omset */
Route::get('/omset', 'OmsetController@index')->name('omset.index');