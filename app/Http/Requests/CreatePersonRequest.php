<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'cpf' => 'required|unique:people,cpf',
            'address.cep' => 'required|digits:8',
            'contact.phone' => 'required',
            'contact.email' => 'required|email',
            'contact.mobile' => 'required'
        ];
    }
}
