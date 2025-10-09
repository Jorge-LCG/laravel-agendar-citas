<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'blood_type_id' => ['nullable', 'integer', 'exists:blood_types,id'],
            'allergies' => ['nullable', 'string'],
            'chronic_conditions' => ['nullable', 'string'],
            'surgical_history' => ['nullable', 'string'],
            'family_history' => ['nullable', 'string'],
            'observations' => ['nullable', 'string'],
            'emergency_contact_name' => ['nullable', 'string', 'max:60'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:9'], 
            'emergency_contact_relationship' => ['nullable', 'string', 'max:60'],
        ];
    }
}
