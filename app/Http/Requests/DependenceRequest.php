<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DependenceRequest extends FormRequest
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
            'name' => 'required ',
            'acronym' => 'required ',
            'country' => 'required ',
            'institute_id' => 'required',
            // name | unique:dependences,name,'.$id
        ];
    }

    public function messages()
    {
        return [
    'name.required' => 'Ingresa nombre de la dependencia',
    'acronym.required' => 'Ingresa las siglas de la dependencia',
    'country.required' => 'Ingresa el país de la dependencia',
    'institute_id.required' => 'Selecciona una institución relacionada',
  ];
    }
}
