<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function index(){
       return City::all();
        
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' =>'required|unique:cities|string'
        ]);
        City::create($request->input());
        return response()->json(array('message' => 'شهر با موفقیت اضافه شد'),201);
    }
}
