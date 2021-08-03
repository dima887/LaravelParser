<?php

namespace App\Http\Requests\ParserApartment;

use Illuminate\Foundation\Http\FormRequest;

class ParserPaginateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start' => ['nullable', 'numeric'],
            'end' => ['nullable', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'start.numeric' => 'Поля должны быть числами',
            'end.numeric' => 'Поля должны быть числами',
        ];
    }
}
