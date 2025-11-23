<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'pet_name',
        'owner_phone',
        'date',
        'time',
        'services',
        'total_value',
    ];

    protected $casts = [
        'services' => 'array',     // armazena serviços como JSON
        'date'     => 'date',
        'time'     => 'datetime:H:i',
        'total_value' => 'decimal:2',
    ];
}

