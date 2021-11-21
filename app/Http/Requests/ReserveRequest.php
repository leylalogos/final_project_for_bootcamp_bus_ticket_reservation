<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ReserveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $capacity = Trip::find($request->trip)->bus->capacity;
        return [
            'seat_number' => [
                'integer',
                'required',
                'min:1',
                "max:$capacity",
                Rule::unique('reservations', 'seat_number')->where('trip_id', $request->trip)
            ]
        ];
    }
}
