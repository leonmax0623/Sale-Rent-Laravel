<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>config('space.sale_route_prefix')],function(){
    Route::get('/','SpaceController@index')->name('sale.search'); // Search
    Route::get('/{property_type_slug}/{uid}/{slug}','SpaceController@detail')->name('sale.detail');// Detail
});


Route::group(['prefix'=>'user/'.config('space.sale_route_prefix'),'middleware' => ['auth','verified']],function(){
    Route::get('/','ManageSpaceController@manageSpace')->name('sale.vendor.index');
    Route::get('/create','ManageSpaceController@createSpace')->name('sale.vendor.create');
    Route::get('/edit/{id}','ManageSpaceController@editSpace')->name('sale.vendor.edit');
    Route::get('/del/{id}','ManageSpaceController@deleteSpace')->name('sale.vendor.delete');
    Route::post('/store/{id}','ManageSpaceController@store')->name('sale.vendor.store');
    Route::get('bulkEdit/{id}','ManageSpaceController@bulkEditSpace')->name("sale.vendor.bulk_edit");
    Route::get('/booking-report/bulkEdit/{id}','ManageSpaceController@bookingReportBulkEdit')->name("sale.vendor.booking_report.bulk_edit");
	Route::get('clone/{id}','ManageSpaceController@cloneSpace')->name("sale.vendor.clone");
    Route::get('/recovery','ManageSpaceController@recovery')->name('sale.vendor.recovery');
    Route::get('/restore/{id}','ManageSpaceController@restore')->name('sale.vendor.restore');
});

Route::group(['prefix'=>'user/'.config('space.sale_route_prefix')],function(){
    Route::group(['prefix'=>'availability'],function(){
        //Route::get('/','AvailabilityController@index')->name('sale.vendor.availability.index');
        Route::get('/loadDates','AvailabilityController@loadDates')->name('sale.vendor.availability.loadDates');
        //Route::post('/store','AvailabilityController@store')->name('sale.vendor.availability.store');
    });
});
