<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetsController extends Controller
{
    public function create()
    {
        return view('system.pets.create');
    }  
}
