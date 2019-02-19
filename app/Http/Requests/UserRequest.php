<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ];
    }
    public function messages()
{
  return [
    'name.required' => 'Olvidaste el nombre del usuario',
    'email.required' => 'Olvidaste el email del usuario',
    'password.min' => 'El password debe tener como mínimo 6 caracteres',
    'password.required' => 'Ingresa tu contraseña',
    'password_confirmation.required' => 'Confirma tu contraseña',
    'password_confirmation.min' => 'El password debe tener como mínimo 6 caracteres',
    'password_confirmation.same'=>'Las contraseñas no coinciden'

   
  ];
}
}
