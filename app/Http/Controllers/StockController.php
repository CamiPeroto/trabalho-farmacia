<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('medicine')->get(); 
        return view('system.stock.index', ['stocks' => $stocks] );
    }
}
