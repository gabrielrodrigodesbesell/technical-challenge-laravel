<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    public $table = 'pessoas';

    protected $dates = [
        'data_nascimento',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'created_at',
        'updated_at'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function pessoaEnderecos()
    {
        return $this->hasMany(Endereco::class, 'pessoa_id', 'id');
    }

    public function getDataNascimentoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDataNascimentoAttribute($value)
    {
        $this->attributes['data_nascimento'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
