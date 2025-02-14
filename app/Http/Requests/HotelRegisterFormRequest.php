<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'place' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'default_facilities' => 'nullable|string',
            'policies' => 'nullable|string',
            'avaialable_room_count' => 'required|integer|min:0',
            'booked_count' => 'required|integer|min:0',
            'rating' => 'required|numeric|min:0|max:5',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }


}
