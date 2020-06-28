<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function(){
	Route::post('/register', 'AuthController@register'); // register
	Route::post('/register_courier', 'AuthController@register_courier'); // register
	Route::post('/login', 'AuthController@login');	// login
	Route::post('/login_courier', 'AuthController@login_courier'); // register

	Route::get('/email/resend', 'VerificationController@resend')->name('verification.resend');
	Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');

	Route::get('/user', 'UserController@users');
	Route::group(['middleware' => 'auth:api'], function(){
		
		Route::get('/logout', 'AuthController@logout');
		
		Route::post('/order', 'OrderController@store');

		Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function(){
			Route::get('/orders', 'AdminController@get_orders');	
			Route::get('/couriers', 'AdminController@get_couriers');

			Route::patch('/assign_order/{courier_id}/{order_id}', 'AdminController@assign_order');
			Route::patch('/update_status/{order_id}', 'OrderController@update_status');		
		});

	});
	Route::group(['middleware' => 'auth:courier', 'prefix' => 'courier'], function(){
		
		Route::get('/orders', 'CourierController@get_orders');

		Route::patch('/update_status/{order_id}', 'OrderController@update_status');		
	});	
});	