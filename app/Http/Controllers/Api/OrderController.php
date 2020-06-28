<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'title' => 'required|string|max:255',
    		'message' => 'required|string',
    		'file' => 'required|max:10000|mimes:doc,docx,pdf,txt',
    		'location' => 'string', // need to be finished
    		'address' => 'string'	// need to be finished
    	]);
    	if($validator->fails()){
    		return response()->json($validator->errors(), 401);
    	}

        $order = new Order;
        ///////////////////////// STORAGE  /////////////////////////////////////
        // get filename with extension
	    $filenameWithExt = $request->file->getClientOriginalName();
	    
	    //get just filename
	    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

	    // get just ext
	    $extension = $request->file->getClientOriginalExtension();

	    //filename to store
	    $fileNameToStore = $filename.'_'.bin2hex(random_bytes(16)).'.'.$extension;

	    //upload image
	    $path = $request->file->storeAs('public/order_files', $fileNameToStore);
        /////////////////////////////////////////////////////////////////////

	    $order->title = $request->title;
	    $order->message = $request->message;
        $order->file = $fileNameToStore; 
    	$order->user()->associate(Auth::user());
        $order->save();

    	return response()->json($order, 201);
    }
}
