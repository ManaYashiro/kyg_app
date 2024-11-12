<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisteredUserRequest extends FormRequest
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
            'name' => 'required|string|min:5',
            'furigana' => 'required|string|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'phone_number' => 'required|string|min:11',
            'post_code' => 'required|integer',
            'address' => 'required|string|min:10',
            'building' => 'required|string|min:10',
            'building' => 'required|string|min:10',
            'preferred_contact_time' => 'required|date_format:H:i',
            'is_newsletter_subscription' => 'nullable|in:"1"',
            'how_did_you_hear' => 'array',
        ];
    }
}
