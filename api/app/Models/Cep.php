<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cep extends Model
{
    use HasFactory;

    public $table = 'ceps';

    //protected $primaryKey = 'id';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'cep',
        'rua',
        'cidade',
        'estado'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function getRouteKeyName()
    {
        return 'cep';
    }
}
