<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
   public function index()
{
    $user = Auth::user();

    $comissions = DB::table('comissions')
        ->join('sales', 'comissions.sale_id', '=', 'sales.id')
        ->select(
            DB::raw('YEAR(sales.sale) as year'),
            DB::raw('MONTH(sales.sale) as month'),
            DB::raw('COUNT(comissions.id) as sales_count'),
            DB::raw('SUM(comissions.value) as total_comission')
        )
        ->where('comissions.user_id', $user->id)
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

    return view('system.profile.index', ['comissions' => $comissions, 'user' => $user]);
}
}
