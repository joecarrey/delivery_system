<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Courier;
use Auth;
use App\HelpTrait;
use App\Role;

class AuthController extends Controller
{
    use HelpTrait;
    protected $creds;

    public function __construct(Request $request)
    {
        $this->creds = $request->only(['email', 'password']);
    }

    public function login(Request $request)
    {	  
    	$valid = $this->validate_login($request);
        if($valid)
            return $valid;

    	$user = User::where('email', $request->email)->first();
    	if(!$user)
    		return response()->json(['error' => 'User not found'], 400);
    	if(!$token = Auth::guard('api')->attempt($this->creds))
    	{
    		return response()->json(['error' => 'Unauthorized'], 401);
    	}

    	$user['token'] = $token;
   		return response()->json($user, 200);
    }

    public function register(Request $request)
    {
        $valid = $this->validate_register($request);
        if($valid)
            return $valid;

        $user = User::create($request->all());
        if(!$token = Auth::guard('api')->attempt($this->creds))
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user['token'] = $token;    
    	$user->roles()->attach('5efdf41efc1d0000ea007949'); 

    	return response()->json($user, 201);
    }
///////////////////////////////////////////////////////////////////////////////////////
    public function login_courier(Request $request)
    {
    	$valid = $this->validate_login($request);
        if($valid)
            return $valid;

    	$courier = Courier::where('email', $request->email)->first();
    	if(!$courier)
    		return response()->json(['error' => 'User not found'], 400);
    	if(!$token = Auth::guard('courier')->attempt($this->creds))
    	{
    		return response()->json(['error' => 'Unauthorized'], 401);
    	}

    	$courier['token'] = $token;
   		return response()->json($courier, 200);
    }

    public function register_courier(Request $request)
    {
        $valid = $this->validate_register($request);
        if($valid)
            return $valid;

    	$courier = Courier::create($request->all()); 
        if(!$token = Auth::guard('api')->attempt($this->creds))
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $courier['token'] = $token;
    	return response()->json($courier, 201);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
