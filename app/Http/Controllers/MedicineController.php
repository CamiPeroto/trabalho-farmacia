<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicineController extends Controller
{
     public function create(){
        
        return view('system.medicines.create');
    }
    public function index(){
        
        return view('system.medicines.index');
    }
}
