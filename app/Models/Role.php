<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;
    
    
    //indicar o nome da tabela
    protected $table = 'roles';

    //indicar quais colunas podem ser preenchidas
    protected $fillable = ['name'];

}
