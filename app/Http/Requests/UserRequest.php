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
        switch ($this->method()) {
            case 'PATCH':
            case 'PUT':
                $rules = [
                    'name' => 'required|string',
                    'email'  => "nullable|email|string|unique:users,email,{$this->user->id}",
                    'password' => 'nullable|string|min:6|confirmed',
                ];
                break;

            default:
                $rules = [
                    'name' => 'required|string',
                    'email'  => 'email|string|unique:users,email',
                    'password' => 'required|string|min:6|confirmed',
                ];
                break;
        }
        return $rules;
    }
}
