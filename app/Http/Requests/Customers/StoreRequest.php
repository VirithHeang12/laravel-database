<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name'           => ['required', 'string'],
            'gender'           => ['required', 'string'],
            'phone'          => ['required', 'string', 'unique:customers', 'min:9', 'max:15'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'name is required.',
            'name.string'           => 'The name field must be a string.',
            'phone.required'        => 'phone is required.',
            'phone.string'          => 'The phone field must be a string.',
            'phone.unique'          => 'Phone Number has already used.',
            'phone.min'             => 'The phone field must be at least 9 character.',
            'phone.max'             => 'The phone field may not be greater than 15 character.',
            'gender.string'             => 'Please select gender.',
        ];
    }
}
