<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password as PasswordRule;

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
        $userId = $this->route('user')?->id;
        $passwordRules = ['nullable', 'confirmed', PasswordRule::min(8)->letters()->symbols()];

        if ($this->isMethod('POST')) {
            array_unshift($passwordRules, 'required');
        }
        
        return [
            'name' => ['required', 'string', 'max:60', 'min:3'],
            'email' => ['required', 'email', 'max:100', Rule::unique('users', 'email')->ignore($userId)],
            'password' => $passwordRules,
            'phone' => ['required', 'numeric', 'digits:9'],
            'dni' => ['required', 'numeric', 'digits:8', Rule::unique('users', 'dni')->ignore($userId)],
            'address' => ['required', 'max:100'],
            'role_id' => ['required', 'exists:roles,id']
        ];
    }
}
