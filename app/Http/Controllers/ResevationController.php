<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Resources\SeatResource;
use App\Http\Resources\SeatCollection;
use App\Models\Trip;
use App\Http\Requests\ReserveRequest;

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

    public function create(ReserveRequest $request, $trip)
    {
        Reservation::create([
            'user_id' => auth()->id(),
            'trip_id' => $trip,
            'seat_number' => $request->seat_number,
            'is_reserved' => false //it will be temprory reserved
        ]);
        return response()->json(array('message' => 'صندلی شما رزرو شد'), 201);
    }
}
