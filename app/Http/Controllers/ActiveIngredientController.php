<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActiveIngredientController extends Controller
{
     public function index(){
        
        return view('system.active-ingredient.index');
    }
}
