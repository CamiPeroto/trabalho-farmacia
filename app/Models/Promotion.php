<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['medicine_id', 'start_date', 'end_date', 'promotional_price'];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];
}
