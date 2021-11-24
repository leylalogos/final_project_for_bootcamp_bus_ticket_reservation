<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SortRequest extends FormRequest
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
            'origin' => 'integer|exists:cities,id|min:1',
            'price' => 'string|in:asc,desc',
            'capacity' => 'string|in:asc,desc',
            'departure_time' => 'date',
            'bus_name' => 'string|in:asc,desc'
        ];
    }
}
