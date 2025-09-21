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
    'pet_id'
  ];

  public function sales()
  {
    return $this->hasMany(Sale::class);
  }

  public function pets()
  {
    return $this->hasMany(Pet::class);
  }
}
