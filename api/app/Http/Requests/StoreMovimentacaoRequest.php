<?php

namespace App\Http\Requests;

use App\Models\Movimentacao;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMovimentacaoRequest extends FormRequest
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
            'valor' => [
                'numeric',
                'required'
            ],
        ];
    }
}
