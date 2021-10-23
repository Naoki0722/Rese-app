<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'shop_name' => 'required',
            'area_id' => 'required',
            'category_id' => 'required',
            'overview' => 'required',
            'img' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'shop_name.required' => '店舗名を入力してください',
            'area_id.required' => 'エリアを選択してください',
            'category_id.required' => 'カテゴリーを選択してください',
            'overview.required' => '説明文を入力してください',
            'img.required' => '画像を選択してください'
        ];
    }
}
