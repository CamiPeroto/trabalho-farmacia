<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
      protected $table = 'stock';

    protected $fillable = [
        'medicine_id',
        // 'purchase_nf_item_id',
        'drugstore_id',
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
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function drugstore()
{
    return $this->belongsTo(Drugstore::class);
}

    // // Relação com itens da nota fiscal (caso esteja rastreando a origem)
    // public function purchaseNfItem()
    // {
    //     return $this->belongsTo(PurchaseNfItem::class);
    // }
}
