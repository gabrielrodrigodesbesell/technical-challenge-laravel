<?php

namespace App\Http\Requests;

use App\Models\Conta;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cpf' => [
                'string',
                'required',
            ],
            'conta' => [
                'string',
                'required',
                'unique:conta'
            ],
        ];
    }
}
