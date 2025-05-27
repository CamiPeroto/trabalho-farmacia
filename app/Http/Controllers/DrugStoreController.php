<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DrugStoreController extends Controller
{
     public function index(){
        
        return view('system.drugstore.index');
    }
}
