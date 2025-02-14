<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessPropertyRequest extends FormRequest
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
            'phone_number' => 'required',
            'type_of_property' => 'required|in:Hotel,Home',
            'is_in_property' => 'required|boolean',
            'address' => 'nullable|array',
            'property_information' => 'required|array',
            'is_property_registered' => 'nullable|boolean',
            'facilities' => 'nullable|array',
            'property_images' => 'required|array|min:6',
            'property_images.*' => 'image|mimes:jpg,jpeg,png',
            'id_proof_name' => 'required|in:PAN,Aadhar',
            'aadhar_number' => 'nullable|required_if:id_proof_name,Aadhar|digits:12',
            'pancard_number' => 'nullable|required_if:id_proof_name,PAN|alpha_num|size:10',
        ];
    }
}
