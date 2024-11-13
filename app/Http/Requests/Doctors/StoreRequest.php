<?php

namespace App\Http\Requests\Doctors;

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
            'full_name'    => ['required', 'string', 'max:100'],
            'specialty'    => ['nullable', 'string', 'max:50'],
            // 'phone_number' => ['required', 'string', 'unique:doctors', 'min:9', 'max:15'],
            'phone_number' => ['required', 'string', 'min:9', 'max:15']
        ];
    }

    public function messages()
    {
        return [
            'full_name.required'    => 'សូមបំពេញឈ្មោះជាមុនសិន',
            'full_name.string'      => 'សូមបំពេញឈ្មោះឱ្យបានត្រឹមត្រូវ',
            'full_name.max'         => 'ឈ្មោះមិនអាចលើសពី 100តួបានឡើយ',
            'specialty.string'      => 'សូមបំពេញឯកទេសឱ្យបានត្រឹមត្រូវ',
            'specialty.max'         => 'ឈ្មោះមិនអាចលើសពី 50តួបានឡើយ',
            'phone_number.required' => 'សូមបំពេញលេខទូរស័ព្ទជាមុនសិន',
            // 'phone_number.unique'   => 'លេខទូរស័ព្ទនេះមានក្នុងប្រព័ន្ធរួចហើយ',
            'phone_number.string'   => 'សូមបំពេញលេខទូរស័ព្ទឱ្យបានត្រឹមត្រូវ',
            'phone_number.min'      => 'លេខទូរស័ព្ទមិនអាចតិចជាង 9តួទេ',
            'phone_number.max'      => 'លេខទូរស័ព្ទមិនអាចលើសពី 15តួទេ',
        ];
    }
}
