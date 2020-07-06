<?php

namespace App;
use Validator;
use App\User;
trait HelpTrait
{
    public function validate_login($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        return null;
    }

    public function validate_register($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        return null;
    }

    public function validate_order($request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'file' => 'required|max:10000|mimes:doc,docx,pdf,txt',
            'location' => 'string', // need to be finished
            'address' => 'string'   // need to be finished
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        return null;
    }

    public function save_file($folder, $file){
        // get filename with extension
        $filenameWithExt = $file->getClientOriginalName();
        
        //get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // get just ext
        $extension = $file->getClientOriginalExtension();

        //filename to store
        $fileNameToStore = $filename.'_'.bin2hex(random_bytes(16)).'.'.$extension;

        //upload image
        $path = $file->storeAs('public/' . $folder, $fileNameToStore);

        return $fileNameToStore; 
    }

    public function find_admin()
    {
        // $admin = User::whereHas(           // whereHas DOES NOT work
        //     'roles', function($q){
        //         $q->where('name', 'admin');
        //     }
        // )->get();
        $admin = User::all()->map(function ($doc) {
                $x = $doc->roles;
                foreach ($x as $role) {
                    if($role->name == 'admin')
                        return $doc;
                }
            });
        foreach ($admin as $a){
            if($a != null)
                $admin = $a;
        }
        return $admin;
    }
}