<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'name'     => 'sometimes|nullable|string',
            'email'    => 'sometimes|nullable|string',
            'password' => 'sometimes|nullable|string',
            'picture'  => 'sometimes|nullable|file',
            'phone'    => 'sometimes|nullable|string',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'id.required' => 'É necessário informar o usuário',
        ];
    }
}
