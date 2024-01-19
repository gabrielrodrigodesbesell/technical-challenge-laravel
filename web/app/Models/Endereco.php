<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Endereco extends Model
{
    use HasFactory;

    public $table = 'enderecos';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'pessoa_id',
        'cep',
        'rua',
        'numero',
        'cidade',
        'estado',
        'created_at',
        'updated_at'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }
}
