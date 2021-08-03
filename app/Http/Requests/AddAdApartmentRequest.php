<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAdApartmentRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'price' => ['nullable', 'numeric'],
            'image' => 'image',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Заполните заголовок объявления',
            'description.required' => 'Напишите описание объявления',
            'address.required' => 'Укажите адрес',
            'price.numeric' => 'Укажите корректно цену',
            'image.image' => 'Не корректный формат файла',
        ];
    }
}
