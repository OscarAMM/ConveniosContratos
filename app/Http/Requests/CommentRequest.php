<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'topic' => 'required ',
            'comment'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'topic.required' => 'Asunto del comentario requerido.',
            'comment.required' => 'Comentario requerido.',
         
        ];
    }
}
