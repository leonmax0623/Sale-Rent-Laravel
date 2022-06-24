<?php

use \Illuminate\Support\Facades\Route;


Route::get('/','SaleController@index')->name('sale.admin.index');
Route::get('/create','SaleController@create')->name('sale.admin.create');
Route::get('/edit/{id}','SaleController@edit')->name('sale.admin.edit');
Route::post('/store/{id}','SaleController@store')->name('sale.admin.store');
Route::post('/bulkEdit','SaleController@bulkEdit')->name('sale.admin.bulkEdit');
Route::get('/recovery','SaleController@recovery')->name('sale.admin.recovery');
Route::get('/getForSelect2','SaleController@getForSelect2')->name('sale.admin.getForSelect2');
Route::get('/all/getForSelect2','SaleController@getAllForSelect2')->name('sale.admin.all.getForSelect2');


Route::group(['prefix'=>'attribute'],function (){
    Route::get('/','AttributeController@index')->name('sale.admin.attribute.index');
    Route::get('edit/{id}','AttributeController@edit')->name('sale.admin.attribute.edit');
    Route::post('store/{id}','AttributeController@store')->name('sale.admin.attribute.store');
    Route::post('/editAttrBulk','AttributeController@editAttrBulk')->name('sale.admin.attribute.editAttrBulk');


    Route::get('terms/{id}','AttributeController@terms')->name('sale.admin.attribute.term.index');
    Route::get('term_edit/{id}','AttributeController@term_edit')->name('sale.admin.attribute.term.edit');
    Route::post('term_store','AttributeController@term_store')->name('sale.admin.attribute.term.store');
    Route::post('/editTermBulk','AttributeController@editTermBulk')->name('sale.admin.attribute.term.editTermBulk');

    Route::get('getForSelect2','AttributeController@getForSelect2')->name('sale.admin.attribute.term.getForSelect2');
});

/*Route::group(['prefix'=>'availability'],function(){
    Route::get('/','AvailabilityController@index')->name('sale.admin.availability.index');
    Route::get('/loadDates','AvailabilityController@loadDates')->name('sale.admin.availability.loadDates');
    Route::post('/store','AvailabilityController@store')->name('sale.admin.availability.store');
});*/
