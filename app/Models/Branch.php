<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';

    protected $fillable = [
        'name', 
        'location', 
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
