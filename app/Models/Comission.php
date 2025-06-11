<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comission extends Model
{
    protected $fillable = ['user_id', 'sale_id', 'value'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
