<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Http\Requests\BusRequest;
use Illuminate\Support\Facades\Gate;


class BusController extends Controller
{
    public function store(BusRequest $request)
    {
        if (!Gate::allows('create-bus')) {
            return response()->json(array('message' => 'شما اجازه تغییر در این صفحه رو ندارید'), 403);
        };

        Bus::create([
            'capacity' => $request->capacity,
            'name' => $request->name,
            'is_vip' => $request->is_vip,
            'user_id' => $request->user_id,
        ]);
        return response()->json(array('message' => 'وسیله نقلیه شما با موفقیت اضافه شد.'), 201);
    }

    public function update(BusRequest $request, Bus $bus)
    {
        if (!Gate::allows('deleteAndUpdateBus', $bus)) {
            return response()->json(array('message' => 'شما اجازه تغییر در این صفحه رو ندارید'), 403);
        };

        $bus->update($request->input());

        return response()->json(array('message' => 'وسیله نقلیه شما با موفقیت بروز رسانی شد'), 200);
    }

    public function destroy(Bus $bus)
    {
        if (!Gate::allows('deleteAndUpdateBus', $bus)) {
            return response()->json(array('message' => 'شما اجازه تغییر در این صفحه رو ندارید'), 403);
        };
        $bus->delete();

        return response()->json(array('message' => 'مورد انتخابی با موفقیت حذف شد.'), 200);
    }
}
