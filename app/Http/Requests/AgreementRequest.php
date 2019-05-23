<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgreementRequest extends FormRequest 
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
            'legalInstrument' =>'required',
            'reception'=>'required',
            'objective'=>'required',
            'instrumentType' => 'required',
            'scope'=>'required',
            'users'=>'required',
            'people_id'=>'required',
            'end_date'=>'nullable',


        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Ingresa nombre del documento.',
            'legalInstrument.required' => 'Ingresa el instrumento jurídico.',
            'reception.required' => 'Ingresa una fecha de recepción válida.',
            'objective.required' => 'Ingresa el objetivo del contrato.',
            'instrumentType.required' => 'Ingresa el tipo de instrumento.',
            'scope.required' => 'Ingresa el ambito del contrato.',
            'users.required' => 'Asigna un usuario.',
            'people_id.required' => 'Asigna suscrito.',
        ];
    }
}
