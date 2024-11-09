<?php

namespace App\Http\Requests\Books;

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
            'title'             => ['required', 'string', 'max:255'],
            'author'            => ['required','string', 'max:255'],
            'published_year'    => ['required', 'string', 'max:5' ],
            'genre'             => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'title.required'    => 'សូមបំពេញចំណងជើងសៀវភៅ',
            'title.string'      => 'សូមបំពេញចំណងជើងសៀវភៅឱ្យបានត្រឹមត្រូវ',
            'title.max'         => 'ចំណងជើងសៀវភៅមិនអាចលើសពី 255 តួបានឡើយ',


            'author.required'   => 'សូមបំពេញឈ្មោះអ្នកនិពន្ធ',
            'author.string'      => 'សូមបំពេញឈ្មោះអ្នកនិពន្ធឱ្យបានត្រឹមត្រូវ',
            'author.max'         => 'ឈ្មោះអ្នកនិពន្ធមិនអាចលើសពី 255 តួបានឡើយ',


            'published_year.string'   => 'សូមបំពេញលេខឆ្នាំនិពន្ធឱ្យបានត្រឹមត្រូវ',
            'published_year.max'      => 'ឆ្នាំមិនអាចលើសពី 5 តួទេ',


            
            'genre.string'   => 'សូមបំពេញប្រភេទសៀវភៅឱ្យបានត្រឹមត្រូវ',
            'genre.max'      => 'ប្រភេទសៀវភៅមិនអាចលើសពី 255 តួបានឡើយ',
        ];
    }
}
