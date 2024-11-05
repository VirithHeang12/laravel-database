<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
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
            'model'         => ['required', 'string', 'unique:cars'],
            'year'          => ['required', 'integer', 'min:1900', 'max:2024'],
            'color'         => ['nullable', 'string'],
            'engine_type'   => ['nullable', 'string'],
            'price'         => ['required', 'numeric', 'min:0']
        ];
    }
}
