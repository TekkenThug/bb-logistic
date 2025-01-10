<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
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
            'email' => 'required|unique:users|email',
            'role' => 'required',
            'password' => ['required', Password::defaults()],
            'confirm_password' => 'required|same:password',
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'address' => 'required_if:role,client',
            'phone_number' => 'required_if:role,courier'
        ];
    }
}
