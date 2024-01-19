<?php

namespace App\Http\Requests;

use App\Models\Cep;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCepRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cep' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'rua' => [
                'string',
                'required',
            ],
            'cidade' => [
                'string',
                'required',
            ],
            'estado' => [
                'string',
                'nullable',
            ],
        ];
    }
}
