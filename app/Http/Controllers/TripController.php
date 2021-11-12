<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Http\Requests\TripRequest;

class TripController extends Controller
{
    public function create(TripRequest $request)
    {
        Trip::create([
            'origin' => $request->origin,
            'price' => $request->price,
            'destination' => $request->destination,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
            'bus_id' => $request->bus_id,

        ]);
        return response()->json(array('message' => 'سفر شما با موفقیت اضافه شد'), 201);
    }

    public function update(TripRequest $request, Trip $trip)
    {

        $trip->update($request->input());
        return response()->json(array('message' => 'سفر شما بروز رسانی شد.'), 204);
    }
}
