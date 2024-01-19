<?php

namespace App\Http\Requests;

use App\Models\Endereco;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEnderecoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cep' => [
                'nullable'
            ],
            'rua' => [
                !empty($this->cep)?'required':null
            ],
            'numero' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                !empty($this->cep)?'required':null
            ],
            'cidade' => [
                !empty($this->cep)?'required':null
            ],
            'estado' => [
                !empty($this->cep)?'required':null
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
