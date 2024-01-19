<?php

namespace App\Http\Requests;

use App\Models\Endereco;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEnderecoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cep' => [
                'string',
                'required',
            ],
            'rua' => [
                'string',
                'required',
            ],
            'numero' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'cidade' => [
                'string',
                'required',
            ],
            'estado' => [
                'string',
                'required',
            ],
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'cep'   => preg_replace('/[^0-9]/', '', $this->cep)
        ]);
    }
}
