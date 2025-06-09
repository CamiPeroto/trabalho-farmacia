<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['client_id', 'sale', 'description', 'total_value'];

    public function comission()
    {
        return $this->hasOne(Comission::class);
    }
    public function products()
{
    return $this->hasMany(SaleProduct::class);
}
}
