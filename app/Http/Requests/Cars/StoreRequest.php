<?php

namespace App\Http\Requests\Cars;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Stop validation on first failure.
     *
     * @var bool
     *
     */
    protected $stopOnFirstFailure = true;

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
            'model'         => ['required', 'string',],
            'year'          => ['required', 'integer', 'min:1900', 'max:2024'],
            'color'         => ['nullable', 'string'],
            'engine_type'   => ['nullable', 'string'],
            'price'         => ['required', 'numeric', 'min:0']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     *
     */
    public function messages(): array
    {
        return [
            'model.required'        => 'ដាក់ឈ្មោះម៉ូដែលត្រូវបានទៅតាមប្រភេទនេះ។',
            'model.string'          => 'The model field must be a string.',
            'model.unique'          => 'ដាក់ឈ្មោះម៉ូដែលមិនបានប្រើប្រាស់ទេ។',
            'year.required'         => 'The year field is required.',
            'year.integer'          => 'The year field must be an integer.',
            'year.min'              => 'The year field must be at least 1900.',
            'year.max'              => 'The year field may not be greater than 2024.',
            'color.string'          => 'The color field must be a string.',
            'engine_type.string'    => 'The engine type field must be a string.',
            'price.required'        => 'The price field is required.',
            'price.numeric'         => 'The price field must be a number.',
            'price.min'             => 'The price field must be at least 0.'
        ];
    }
}
