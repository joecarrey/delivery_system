<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Courier;

class AdminController extends Controller
{
    public function get_orders()
    {
    	$orders = Order::all()->map(function ($ord) {
            $ord->user;
            return $ord;
        });;
    	
    	return response()->json($orders, 200);
    }

	public function get_couriers()
    {
    	$couriers = Courier::all();
    	return response()->json($couriers, 200);
    }

    public function assign_order($courier_id, $order_id)
    {
    	$courier = Courier::findOrFail($courier_id);
    	$order = Order::findOrFail($order_id);
    	$order->courier()->associate($courier);
    	$order->save();

    	return response()->json($order, 200);
    }

    public function activate_courier($courier_id)
    {
        $courier = Courier::findOrFail($courier_id);
        $courier->is_active = true;
        $courier->save();
        return response()->json(['message' => 'Courier ' . $courier->name . ' is activated'], 200);
    }

    public function delete_courier($courier_id)
    {
        $courier = Courier::findOrFail($courier_id);
        $courier->delete();
        if (!empty(get_object_vars($courier->orders)))           
            $courier->orders[0]->unset('courier_id');
        return response()->json(['message' => 'Courier ' . $courier->name . ' has been deleted'], 200);
    }   
}
