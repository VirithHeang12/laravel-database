<?php

namespace App\Http\Requests\Suppliers;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    /**
     * Stop validation on first failure.
     *
     *
     * @var bool
     *
     *
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
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required','email', 'unique:suppliers'],
            'phone'      => ['required', 'string', 'max:20'],
            'address'    => ['required', 'string', 'max:255'],
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     *
     */
    public function messages(): array{
        return [
            'name.required'       => 'The supplier name field is required.',
            'name.string'         => 'The supplier name must be a string.',
            'name.max'            => 'The supplier name may not be greater than 255 characters.',
            'email.required'      => 'The supplier email field is required.',
            'email.email'         => 'The supplier email must be a valid email address.',
            'email.unique'        => 'The supplier email has already been taken.',
            'phone.required'      => 'The supplier phone field is required.',
            'phone.string'        => 'The supplier phone must be a string.',
            'phone.max'           => 'The supplier phone may not be greater than 20 characters.',
            'address.required'    => 'The supplier address field is required.',
            'address.string'      => 'The supplier address must be a string.',
            'address.max'         => 'The supplier address may not be greater than 255 characters.',
        ];
    }

}
