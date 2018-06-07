<?php

namespace App\Http\Requests\Api;

class CategoryRequest extends FormRequest
{

    public function rules()
    {
        return [
           'name' => 'required|max:20|min:3',
           'introduction' => 'max:100',
        ];
    }

    public function attributes()
    {
        return [
          'name' => '分组名',
          'introduction' => '分组描述',
        ];
    }
}
