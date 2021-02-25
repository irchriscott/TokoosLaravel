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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//ADMIN ROUTES

Route::group(['namespace' => 'Admin'], function (){
    Route::prefix('admin')->group(function(){
        Route::get('/login','AdminController@adminLogin')->name('admin.login');
        Route::get('/index','AdminController@index')->name('admin.index')->middleware('auth');
        Route::resource('/riders','RiderController')->middleware('auth');
        Route::resource('/ride/type','RideTypeController')->names([
            'index' => 'ride_type.index',
            'create' => 'ride_type.create',
            'store' => 'ride_type.store',
            'show' => 'ride_type.show',
            'edit' => 'ride_type.edit',
            'update' => 'ride_type.update',
            'destroy' => 'ride_type.destroy'
        ])->middleware('auth');
    });
});

Route::group(['namespace' => 'Api'], function (){
    Route::prefix('api/v1')->group(function(){

        //USER & RIDER AUTH
        Route::post('/user/register/phone-number', 'UserController@registerPhoneNumber');
        Route::post('/user/register/identity', 'UserController@saveUserIdentity');
        Route::post('/user/auth/phone-number', 'UserController@authenticatePhoneNumber');
        
        Route::post('/rider/auth/phone', 'RiderController@authPhone');
        Route::post('/rider/auth/code', 'RiderController@authCode');

        Route::get('/ride/request/fares', 'RideController@requestRideFares');
        Route::post('/ride/request/riders', 'RideController@requestRiders');
        Route::post('/ride/request/initiate', 'RideController@initiateRide');
    });
});

Route::get('/login', function(){
    return redirect(route('admin.login'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
