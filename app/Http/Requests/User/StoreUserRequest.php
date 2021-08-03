<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Заполните email',
            'email.email' => 'Введите корректный email',
            'email.unique' => 'Данный email уже существует',
            'name.required' => 'Заполните имя',
            'password.required' => 'Заполните пароль',
        ];
    }
}
