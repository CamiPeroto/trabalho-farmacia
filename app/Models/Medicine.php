<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = 'medicines';
    
    protected $fillable = [
        'fantasy_name',
        'type', 
        'form', 
        'dosage', 
        'maker', 
        'description',  
        'image', 
        'active_ingredient_id'];
}
