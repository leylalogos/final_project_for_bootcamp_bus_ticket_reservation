<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Resources\SeatResource;
use App\Http\Resources\SeatCollection;
use App\Models\Trip;
use App\Http\Requests\ReserveRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;


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
        if (!Gate::allows('reserve')) {
            abort(403);
        }
        foreach ($request->seat_numbers as $seat_number) {
            Reservation::create([
                'user_id' => auth()->id(),
                'trip_id' => $trip,
                'seat_number' => $seat_number,
                'is_reserved' => false //it will be temprory reserved
            ]);
        }

        return response()->json(array('message' => 'صندلی شما رزرو شد'), 201);
    }

    public function ShowReceipt(Trip $trip)
    {
        
        return [
            'name' => auth()->user()->name,
            'price' => $trip->UserReservedTotalPrice,
            'passenger_count' => $trip->userReservedSeatCount,
            'origin' => $trip->from->name,
            'destination' => $trip->to->name,
            'departure_time' => $trip->departure_time,
            'bus_company_name' => $trip->bus->user->name,
        ];
    }
}
