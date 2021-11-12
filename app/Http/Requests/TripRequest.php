<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
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
    public function rules()
    {
        return [
            'origin' => 'required|integer|exists:cities,id',
            'destination' => 'required|integer|exists:cities,id',
            'price' => 'required|integer|min:1',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
            'bus_id' => 'required|integer|exists:buses,id'
        ];
    }
}
