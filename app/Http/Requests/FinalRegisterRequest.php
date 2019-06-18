<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinalRegisterRequest extends FormRequest
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
            'legalInstrument' => 'required',
            'objective' => 'required',
            'registerNumber' => 'required',
            'signature' => 'required',
            'start_date' => 'required',
            'end_date' => 'nullable',
            'session' => 'required',
            'scope' => 'required',
            'hide' => 'required',
            'instrumentType' => 'required',
            'observation' => 'nullable',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nombre del documento requerido.',
            'legalInstrument.required' => 'Instrumento jurídico requerido.',
            'objective.required' => 'Objetivo requerido.',
            'registerNumber.required' => 'Número de registro requerido.',
            'instrumentType.required' => 'Tipo de instrumento requerido.',
            'scope.required' => 'Ámbito del documento requerido.',
            'signature.required' => 'Fecha de firma requerido.',
            'start_date.required' => 'Fecha de inicio requerido.',
            'session.required' => 'Fecha de sesión requerido.',
        ];
    }
}
