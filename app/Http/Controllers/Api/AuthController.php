<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
// use App\Role;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    	$creds = $request->only(['email', 'password']);
    	
    	$validator = Validator::make($request->all(), [
    		'email' => 'required|email',
    		'password' => 'required|string|min:8',
    	]);
    	if($validator->fails()){
    		return response()->json($validator->errors(), 401);
    	}

    	$user = User::where('email', $request->email)->first();

    	if(!$token = auth()->attempt($creds))
    	{
    		return response()->json(['error' => 'Unauthorized', 401]);
    	}

    	$user['token'] = $token;
   		return response()->json($user, 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
    		'name' => 'required|string|max:255|min:3',
    		'email' => 'required|email|max:255',
    		'password' => 'required|string|min:8',
    	]);
    	if($validator->fails()){
    		return response()->json($validator->errors(), 401);
    	}

    	$user = User::create($request->all());
    	$user->roles()->attach('5ef68a5128350000b6004994'); 

    	return response()->json($user, 201);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
