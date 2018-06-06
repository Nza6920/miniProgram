<?php

namespace App\Http\Requests\Api;

class AuthorizeInformation extends FormRequest
{
    public function rules()
    {
        return [
            'iv' => 'required|string',
            'encryptedData' => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'iv' => '初始向量',
            'encryptedData' => '加密数据',
        ];
    }
}
