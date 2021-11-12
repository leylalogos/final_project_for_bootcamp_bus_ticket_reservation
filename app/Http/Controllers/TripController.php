<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;

class TripController extends Controller
{
    public function create(Request $request)
    {
        Trip::create([
            'origin' => $request->origin,
            'price' => $request->price,
            'destination' => $request->destination,
            'departure-time' => $request->departure,
            'arrival-time' => $request->arrival,
            'bus_id' =>$request->bus_id,

        ]);
        return response()->json(array('message' => 'trip'), 201);
    }
}
