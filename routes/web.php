<?php

/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/intro','\App\Http\Controllers\LandingpageController@index');

Route::get('/', '\App\Http\Controllers\HomeController@index');

Route::get('/home', '\App\Http\Controllers\HomeController@index')->name('home');

Route::post('/install/check-db', '\App\Http\Controllers\HomeController@checkConnectDatabase');




Route::get('/update', function (){

    return redirect('/');

});



//Cache

//Route::get('/clear-cache', function() {
//
//    Artisan::call('cache:clear');
//
//    return "Cleared!";
//
//})->middleware(['auth', 'dashboard']);


Route::get('/clear/config', function() {

    Artisan::call('optimize:clear');
    Artisan::call('config:clear');

    return "Cleared!";

});



//Login

Auth::routes();

//Custom User Login and Register

Route::get('login/{email_verify_code?}','\App\Http\Controllers\Auth\LoginController@showLoginForm');
Route::post('register','\Modules\User\Controllers\UserController@userRegister')->name('auth.register');

Route::post('login','\Modules\User\Controllers\UserController@userLogin')->name('auth.login');

Route::post('logout','\Modules\User\Controllers\UserController@logout')->name('auth.logout');

// Social Login

Route::get('social-login/{provider}', '\App\Http\Controllers\Auth\LoginController@socialLogin');

Route::get('social-callback/{provider}', '\App\Http\Controllers\Auth\LoginController@socialCallBack');



// Logs

Route::get('admin/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware(['auth', 'dashboard','system_log_view']);

