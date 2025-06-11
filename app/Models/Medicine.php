<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = 'medicines';

    protected $fillable = [
        'fantasy_name',
        'price',
        'type',
        'form',
        'dosage',
        'maker',
        'quantity',
        'description',
        'image',
        'active_ingredient_id'];

    public function activeIngredient()
    {
        return $this->belongsTo(ActiveIngredient::class);
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
