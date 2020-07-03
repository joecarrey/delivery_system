<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Order;
use App\User;
use App\HelpTrait;
use App\Jobs\NewOrderJob;

class OrderController extends Controller
{
    use HelpTrait;

    public function store(Request $request)
    {
    	$valid = $this->validate_order($request);
        if($valid)
            return $valid;

        $order = new Order;

        $file = $this->save_file('order_files', $request->file('file'));

	    $order->title = $request->title;
	    $order->text = $request->text;
        $order->file = $file; 
    	$order->user()->associate(Auth::user());
    	$order->status = Order::STATUS_REQUESTED;
        $order->save();

        dispatch(new NewOrderJob($order));
        
    	return response()->json($order, 201);
    }

    public function update_status(Request $request, $order_id)
    {
    	$order = Order::findOrFail($order_id);
    	$order->status = $request->status;
    	$order->save();

    	return response()->json($order, 200);
    }

    public function order_info($order_id)
    {
    	$order = Order::findOrFail($order_id);
		return response()->json($order, 200);
    }
}
