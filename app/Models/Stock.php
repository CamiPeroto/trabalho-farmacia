<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';

    protected $fillable = [
        'product_id',
        'branch_id',
        'quantity',
        'unitary_price',
        'expiration_date',
        'status',
        'entry_date',
    ];

    protected $casts = [
        'expiration_date' => 'date',
        'entry_date' => 'date',
        'unitary_price' => 'decimal:2',
    ];

    // Relação com a tabela de remédios
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function species()
    {
        return $this->belongsTo(Species::class);
    }

    public function branch()
{
    return $this->belongsTo(Branches::class, 'branch_id');
}
}
