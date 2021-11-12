<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Http\Requests\BusRequest;

class BusController extends Controller
{
    public function store(BusRequest $request)
    {
        Bus::create([
            'capacity' => $request->capacity,
            'name' => $request->name,
            'is_vip' => $request->is_vip,
            'user_id' => $request->user_id,
        ]);
        return response()->json(array('message' => 'وسیله نقلیه شما با موفقیت اضافه شد.'), 201);
    }

    public function update(Request $request, Bus $bus)
    {

        $bus->update($request->input());

        return response()->json(array('message' => 'وسیله نقلیه شما با موفقیت بروز رسانی شد'), 204);
    }
    
    public function destroy(Bus $bus)
    {
        $bus->delete();

        return response()->json(array('message' => 'مورد انتخابی با موفقیت حذف شد.'), 202);
    }
}
