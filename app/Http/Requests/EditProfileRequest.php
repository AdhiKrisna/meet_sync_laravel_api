<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'name' => ['string', 'min:8', 'max:30'],
            'email' => ['email', 'max:255'],
            'password' => ['string', Password::min(8), 'confirmed'],
            'role' => ['string', 'in:lecture,student'],
            'phone_number' => ['string'],
        ];
    }
}
