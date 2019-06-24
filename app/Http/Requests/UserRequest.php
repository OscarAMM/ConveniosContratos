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
    'name.required' => 'Nombre de usuario requerido.',
    'email.required' => 'Email requerido o se encuentra registrado.',
    'password.min' => 'La contraseña debe tener como mínimo 6 caracteres',
    'password.required' => 'Contraseña requerida. ',
    'password_confirmation.required' => 'Confirma tu contraseña',
    'password_confirmation.min' => 'El password debe tener como mínimo 6 caracteres',
    'password_confirmation.same'=>'Las contraseñas no coinciden'

   
  ];
}
}
