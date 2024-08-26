<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequestCreateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'request' => 'required|string',
        ];
    }
}
