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
            'end_date' => 'required',
            'session' => 'required',
            'scope' => 'required',
            'hide' => 'required',
            'instrumentType' => 'required',
            'observation' => 'nullable',
        ];
    }
}
