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
            'origin' => 'required|integer',
            'destination' => 'required|integer',
            'price' => 'required|integer',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'bus_id' => 'required|integer'
        ];
    }
}
