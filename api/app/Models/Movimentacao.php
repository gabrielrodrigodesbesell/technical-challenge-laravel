<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;

    public $table = 'movimentacoes';

    public const ACAO_RADIO = [
        '0' => 'Retirar',
        '1' => 'Depositar',
    ];

    protected $dates = [
        'data',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'conta_id',
        'data',
        'valor',
        'created_at',
        'updated_at'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }


    public function getDataAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getValorAttribute($value)
    {
        return number_format($value, 2, '', '');
    }
}
