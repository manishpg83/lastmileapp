<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => 'required|string|regex:/^\+?[1-9]\d{1,14}$/',
            'password' => 'required|string', // For OTP-based login, you might want to change this to 'nullable|string'
            'device_id' => 'nullable|string|max:255',
            'device_name' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Please enter a valid phone number.',
        ];
    }
}