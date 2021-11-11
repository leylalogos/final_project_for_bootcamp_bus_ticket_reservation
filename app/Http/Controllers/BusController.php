<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;

class BusController extends Controller
{
    public function store(Request $request)
    {
        Bus::create([
            'capacity' => $request->capacity,
            'name' => $request->name,
            'is_vip' => $request->is_vip,
            'user_id' => $request->user_id,
        ]);
        return response()->json(array('message' => 'bus  successfully created'), 201);
    }

    public function update(Request $request, Bus $bus)
    {
        $bus->update($request->input());

        return response()->json(array('message' => 'bus updated successfully'), 201);
    }
    public function destroy(Bus $bus)
    {
        $bus->delete();
        return response()->json(array('message' => 'bus deleted successfully'), 201);

    }
}
