<?php

namespace App\Http\Requests\Doctors;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $doctor = $this->route('doctor');
        return [
            'full_name'    => ['required', 'string', 'max:100'],
            'specialty'    => ['nullable', 'string', 'max:50'],
            'phone_number' => ['required', 'string', 'min:9', 'max:15', 'unique:doctors,phone_number,' . $doctor->id]
        ];
    }
}

