<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drugstore extends Model
{
    protected $table = 'drugstores';

    protected $fillable = ['name', 'location', 'status'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
