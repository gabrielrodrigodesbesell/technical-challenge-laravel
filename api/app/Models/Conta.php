<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    public $table = 'conta';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'cpf',
        'conta',
        'created_at',
        'updated_at'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class);
    }
}
