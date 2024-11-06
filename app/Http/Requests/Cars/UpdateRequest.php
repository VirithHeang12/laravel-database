<?php

namespace App\Http\Requests\Cars;

use App\Models\Car;
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
    public function rules(Car $car): array
    {
        return [
            'model'         => ['required', 'string', 'unique:cars,model,' . $car->id],
            'year'          => ['required', 'integer', 'min:1900', 'max:2024'],
            'color'         => ['nullable', 'string'],
            'engine_type'   => ['nullable', 'string'],
            'price'         => ['required', 'numeric', 'min:0']
        ];
    }
}
