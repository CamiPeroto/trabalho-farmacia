<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'client_id',
        'species_id',
        'name',
        'race',
        'age',
        'weight',
        'description'
    ];

    public function species()
    {
        return $this->hasOne(Species::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
