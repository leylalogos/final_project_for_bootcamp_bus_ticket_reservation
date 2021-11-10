<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        
        $rules = [
            
            'name' => 'string',
            'password' => 'required|string|min:6',
            'email' => 'required|string|email|unique:users,email',
        ];

        $validator = Validator::make($request->all(), $rules);
        //dd($validator->fails());
        if ($validator->fails()) {
            return response()->json(array('message' => 'eror'), 400);
        }
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'mobile' => $request->mobile
        ]);

        return response()->json(array('message' => 'user created successfully'), 201);
    }
}
