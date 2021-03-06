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

	Route::group(['middleware' => 'auth:api'], function(){
		
		Route::get('/logout', 'AuthController@logout');
		
		Route::post('/order', 'OrderController@store');

		Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function(){
			Route::get('/couriers', 'AdminController@get_couriers');
			Route::get('/orders', 'AdminController@get_orders');	
			Route::get('/order/{order_id}', 'OrderController@order_info');

			Route::patch('/assign_order/{courier_id}/{order_id}', 'AdminController@assign_order');
			Route::patch('/activate_courier/{courier_id}', 'AdminController@activate_courier');
			Route::patch('/update_status/{order_id}', 'OrderController@update_status');

			Route::delete('/del_courier/{courier_id}', 'AdminController@delete_courier');		
		});
	});
	Route::group(['middleware' => 'auth:courier', 'prefix' => 'courier'], function(){
		
		Route::get('/orders', 'CourierController@get_orders');
		Route::get('/order/{order_id}', 'OrderController@order_info');

		Route::patch('/update_status/{order_id}', 'OrderController@update_status');		
	});	
});	