<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Medicine::all();
        return view('ecommerce.home.index',[ 'products' => $products]);
    }  
}
