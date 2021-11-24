<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class BusRequest extends FormRequest
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
            'capacity' => 'required|integer|min:1',
            'name' => 'required|string',
            'is_vip' => 'required|boolean',
            'user_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')
                    ->where('role_id', User::USER_TYPE_COMPANY),
            ],
        ];
    }
}
