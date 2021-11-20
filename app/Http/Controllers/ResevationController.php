<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Resources\SeatResource;
use App\Http\Resources\SeatCollection;
use App\Models\Trip;

class ResevationController extends Controller
{
    public function index($trip)
    {
        return (new SeatCollection(
            Reservation::where("trip_id", $trip)->get()
        ))->additional([
            'capacity' => Trip::find($trip)->bus->capacity
        ]);
    }

    public function create(Request $request, $trip, $seat)
    {

        Reservation::create([
            'user_id' => $request->s
        ]);
    }
}
