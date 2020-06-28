<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Order;

class CourierController extends Controller
{
	public function get_orders()
	{
		$orders = Order::where('courier_id', Auth::user()->_id)->get();
		return response()->json($orders, 200);
	}   
}
