<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $table = 'appointments';
    
    protected $fillable = [
        'name', 
        'phone',
        'time',
        'hours',
        'value',
        'total_value'
    ];
}
