<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Http\Requests\TripRequest;
use App\Models\Bus;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\TripResource;

class TripController extends Controller
{
    public function index()
    {
        return  TripResource::collection(Trip::all());
    }

    public function create(TripRequest $request)
    {
        if (!Gate::allows('deleteAndUpdateBus', Bus::find($request->bus_id))) {
            abort(403);
        }

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
        if (!Gate::allows('deleteAndUpdateBus', $trip->bus)) {
            abort(403);
        }

        $trip->update($request->input());
        return response()->json(
            array('message' => 'سفر شما بروز رسانی شد'),
            200
        );
    }
}
