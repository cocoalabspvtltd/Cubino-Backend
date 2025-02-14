<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
            'hotel'      => 'required',
            'description'   => 'nullable|string|max:500',
            'aminities'     => 'required|string|max:255',
            'price'         => 'required|string',
            'guest_limit'   => 'required|integer|min:1',
            'room_images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image
        ];
    }

     /**
     * Custom messages for validation errors.
     */
    public function messages()
    {
        return [
            'hotel_id.required' => 'Select a hotel,field is required',
            'aminities.required' => 'The aminities field is required.',
            'price.required' => 'The price field is required.',
            'guest_limit.required' => 'The guest limit field is required.',
            'avaialable_room_count.required' => 'The available room count is required.',
            'booked_count.required' => 'The booked count is required.',
            'rating.required' => 'The rating is required.',
            'room_images.*.required' => 'Please upload at least one image.',
            'room_images.*.image' => 'Each file must be an image.',
            'room_images.*.mimes' => 'Images must be in JPG, JPEG, or PNG format.',
            'room_images.*.max' => 'Each image size must not exceed 2 MB.',
        ];
    }
}
