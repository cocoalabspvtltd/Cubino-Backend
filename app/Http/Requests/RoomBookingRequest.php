<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomBookingRequest extends FormRequest
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
            'room_id' => 'required|exists:hotel_rooms,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:confirmed,canceled',
            'guest_count' => 'required',
            'room_count' => 'required'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'room_id.required' => 'The room ID is required.',
            'room_id.exists' => 'The selected room does not exist.',
            'start_date.required' => 'The start date is required.',
            'end_date.required' => 'The end date is required.',
            'status.required' => 'The status is required.',
            'status.in' => 'The status must be either "confirmed" or "canceled".',
        ];
    }
}
