<?php

namespace App\Http\Requests;

use App\Models\Pessoa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use LaravelLegends\PtBrValidator\Rules\Cpf;

class StorePessoaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => [
                'string',
                'min:2',
                'max:255',
                'required',
                function ($attribute, $value, $fail) {
                    if (str_word_count($value)<2) {
                        $fail('Digite o nome completo.');
                    }
                },
            ],
            'cpf' => [
                'string',
                'required',
                'cpf',
                'unique:pessoas',
            ],
            'data_nascimento' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
                function ($attribute, $value, $fail) {
                    if (!empty($value) && strtotime(str_replace('/', '-', $value)) > strtotime(date('d-m-Y'))) {
                        $fail('A data não pode ser maior que '.date('d/m/Y'));
                    }
                },
            ],
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'cpf'   => preg_replace('/[^0-9]/', '', $this->cpf),
            'nome'  => ucwords(strtolower($this->nome)),
        ]);
    }
}
