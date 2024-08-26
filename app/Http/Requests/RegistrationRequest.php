<?php

namespace Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|string'
        ];
    }
}
