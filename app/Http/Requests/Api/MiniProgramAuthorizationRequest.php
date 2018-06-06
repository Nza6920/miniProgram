<?php

namespace App\Http\Requests\Api;

class MiniProgramAuthorizationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required|string',
        ];
    }
}
