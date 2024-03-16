<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return match ($this->method()) {
            'PATCH', 'PUT' => [
                'name' => 'required|string',
                'email' => "nullable|email|unique:users,email,{$this->user->id}",
                'password' => 'nullable|string|min:6|confirmed',
                "avatar" => "nullable|mimes:jpeg,jpg,png,svg,webp|image|max:2048",
            ],
            default => [
                'name' => 'required|string',
                'email' => 'email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                "avatar" => "nullable|mimes:jpeg,jpg,png,svg,webp|image|max:2048",
            ],
        };
    }
}
