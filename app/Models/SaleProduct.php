<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
     protected $fillable = [
        'sale_id',
        'medicine_id',
        'quantity',
        'unit_price',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
     public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
