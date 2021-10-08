<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
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
            'user_id' => 'required',
            'shop_id' => 'required',
            'day' => 'required',
            'time' => 'required',
            'number_of_people' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'ログインしてください',
            'shop_id.required' => '予約する店が指定されていません',
            'day.required' => '日にちを入力してください',
            'time.required' => '時間を入力してください',
            'number_of_people.required' => '来店人数を入力してください'
        ];
    }

    
}
