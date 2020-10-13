<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class InsertUser extends FormRequest
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
            'name'         => 'required',
            'email'        => 'required',
            'phone'        => 'required',
            'user_type_id' => 'required',
            'password'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'          => 'É necessário o usuário ter um nome',
            'name.phone'             => 'É necessário o usuário ter um telefone',
            'email.required'         => 'É necessário o usuário ter um email',
            'user_type_id.required'  => 'É necessário o usuário ter um Suporte ou Empresa',
            'password.required'      => 'É necessário o usuário ter uma senha',
        ];
    }

}
