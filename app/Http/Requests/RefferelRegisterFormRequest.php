<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefferelRegisterFormRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'phone_number' => ['required', 'regex:/^\+\d{1,4}\s\d{4,15}$/', 'unique:users,phone_number'],
            'referral_code' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The Name field is required.',
            'email.required' => 'The Email field is required.',
            'email.unique' => 'This email already exists in our records.',
            'phone_number.regex' => 'The phone number must start with country Code',
            'phone_number.unique' => 'This Phone Number already exists in our records.',
            'referral_code.required' => 'The Referral Code field is required.',
        ];
    }
}
