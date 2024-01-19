<?php

namespace App\Http\Requests;

use App\Models\Movimentacao;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMovimentacaoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'conta_id' => [
                'required',
                'integer',
            ],
            'data' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'acao' => [
                'required',
            ],
            'valor' => [
                'numeric',
                'required',
                'min:0',
            ],
        ];
    }
}
