<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorRequest extends FormRequest
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
        $doctorId = $this->route('doctor')?->id;

        return [
            'speciality_id' => ['nullable', 'exists:specialities,id'],
            'medical_license_number' => ['nullable', 'string', 'max:255', Rule::unique('doctors', 'medical_license_number')->ignore($doctorId)],
            'biography' => ['nullable', 'string'],
            'active' => ['required', 'boolean']
        ];
    }
}
