<?php

namespace App\Http\Requests\Api;


class CardRequest extends FormRequest
{

    public function rules()
    {
        return [
            'front' => 'required|max:50|min:3',
            'behind' => 'max:50|min:3',
            'category_id' => 'required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'front' => '正面',
            'behind' => '反面',
            'category_id' => '分组id',
        ];
    }
}
