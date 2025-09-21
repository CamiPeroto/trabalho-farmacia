<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'type',
        'shape',
        'weight',
        'code_product',
        'maker',
        'quantity',
        'image',
        'species_id'
    ];
    
    public function species()
    {
        return $this->belongsTo(Species::class);
    }

    public function promotion()
    {
        return $this->hasOne(Promotion::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
