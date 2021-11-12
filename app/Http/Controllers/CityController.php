<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function create(Request $request)
    {
        City::create($request->input());
        return response()->json(array('message' => 'city'),200);
    }
}
