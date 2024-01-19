<?php

namespace App\Http\Requests;

use App\Models\Conta;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContaRequest extends FormRequest
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
                'unique:conta,conta,' . request()->segment(4)
            ],
        ];
    }
}
