<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationRequest extends FormRequest
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
            'evaluation' => 'required',
            'comment' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'evaluation.required' => '評価を選択してください',
            'comment.required' => 'コメントを入力してください',
        ];
    }
}
