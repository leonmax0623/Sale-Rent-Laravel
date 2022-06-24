<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>config('space.rental_route_prefix')],function(){
    Route::get('/','SpaceController@index')->name('rental.search'); // Search
    Route::get('/{slug}','SpaceController@detail')->name('rental.detail');// Detail
});


Route::group(['prefix'=>'user/'.config('space.rental_route_prefix'),'middleware' => ['auth','verified']],function(){
    Route::get('/','ManageSpaceController@manageSpace')->name('rental.vendor.index');
    Route::get('/create','ManageSpaceController@createSpace')->name('rental.vendor.create');
    Route::get('/edit/{id}','ManageSpaceController@editSpace')->name('rental.vendor.edit');
    Route::get('/del/{id}','ManageSpaceController@deleteSpace')->name('rental.vendor.delete');
    Route::post('/store/{id}','ManageSpaceController@store')->name('rental.vendor.store');
    Route::get('bulkEdit/{id}','ManageSpaceController@bulkEditSpace')->name("rental.vendor.bulk_edit");
    Route::get('/booking-report/bulkEdit/{id}','ManageSpaceController@bookingReportBulkEdit')->name("rental.vendor.booking_report.bulk_edit");
	Route::get('clone/{id}','ManageSpaceController@cloneSpace')->name("rental.vendor.clone");
    Route::get('/recovery','ManageSpaceController@recovery')->name('rental.vendor.recovery');
    Route::get('/restore/{id}','ManageSpaceController@restore')->name('rental.vendor.restore');
});

Route::group(['prefix'=>'user/'.config('space.rental_route_prefix')],function(){
    Route::group(['prefix'=>'availability'],function(){
        Route::get('/','AvailabilityController@index')->name('rental.vendor.availability.index');
        Route::get('/loadDates','AvailabilityController@loadDates')->name('rental.vendor.availability.loadDates');
        Route::post('/store','AvailabilityController@store')->name('rental.vendor.availability.store');
    });
});
