<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
       protected $fillable = [
        'name',
        'email',
        'cpf',
        'phone_number',
    ];
      public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
