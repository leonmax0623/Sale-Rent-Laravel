<?php

use \Illuminate\Support\Facades\Route;


Route::get('/','PropertyRentalController@index')->name('rental.admin.index');
Route::get('/create','PropertyRentalController@create')->name('rental.admin.create');
Route::get('/edit/{id}','PropertyRentalController@edit')->name('rental.admin.edit');
Route::post('/store/{id}','PropertyRentalController@store')->name('rental.admin.store');
Route::post('/bulkEdit','PropertyRentalController@bulkEdit')->name('rental.admin.bulkEdit');
Route::get('/recovery','PropertyRentalController@recovery')->name('rental.admin.recovery');
Route::get('/getForSelect2','PropertyRentalController@getForSelect2')->name('rental.admin.getForSelect2');
Route::get('/all/getForSelect2','PropertyRentalController@getAllForSelect2')->name('rental.admin.all.getForSelect2');


Route::group(['prefix'=>'attribute'],function (){
    Route::get('/','AttributeController@index')->name('rental.admin.attribute.index');
    Route::get('edit/{id}','AttributeController@edit')->name('rental.admin.attribute.edit');
    Route::post('store/{id}','AttributeController@store')->name('rental.admin.attribute.store');
    Route::post('/editAttrBulk','AttributeController@editAttrBulk')->name('rental.admin.attribute.editAttrBulk');


    Route::get('terms/{id}','AttributeController@terms')->name('rental.admin.attribute.term.index');
    Route::get('term_edit/{id}','AttributeController@term_edit')->name('rental.admin.attribute.term.edit');
    Route::post('term_store','AttributeController@term_store')->name('rental.admin.attribute.term.store');
    Route::post('/editTermBulk','AttributeController@editTermBulk')->name('rental.admin.attribute.term.editTermBulk');

    Route::get('getForSelect2','AttributeController@getForSelect2')->name('rental.admin.attribute.term.getForSelect2');
});

Route::group(['prefix'=>'availability'],function(){
    Route::get('/','AvailabilityController@index')->name('rental.admin.availability.index');
    Route::get('/loadDates','AvailabilityController@loadDates')->name('rental.admin.availability.loadDates');
    Route::post('/store','AvailabilityController@store')->name('rental.admin.availability.store');
});
