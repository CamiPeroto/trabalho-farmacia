<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'product_id', 
        'start_date', 
        'end_date', 
        'promotional_price'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
