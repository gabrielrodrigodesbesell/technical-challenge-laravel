<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    public const ACAO_RADIO = [
        '0' => 'Retirar',
        '1' => 'Depositar',
    ];

}
