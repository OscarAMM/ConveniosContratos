<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest 
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
            'reception'=>'required',
            'objective'=>'required',
            'contractValidity'=>'required',
            'scope'=>'required',
            'users'=>'required',
            'institute_id'=>'required',
            
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Ingresa nombre del contrato',
            'reception.required' => 'Ingresa una fecha de recepción válida',
            'objective.required' => 'Ingresa el objetivo del contrato',
            'contractValidity.required' => 'Ingresa una fecha de fin válida',
            'scope.required' => 'Ingresa el ambito del contrato',
            'users.required' => 'Asigna un usuario',
            'institute_id.required' => 'Asigna un instituto',
        ];
    }
}
