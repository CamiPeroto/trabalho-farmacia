<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index()
    {
        $user        = Auth::user();
        $drugstoreId = $user->drugstore_id;

        $medicines = Medicine::whereHas('stock', function ($query) use ($drugstoreId) {
            $query->where('drugstore_id', $drugstoreId);
        })->get();

        // Adiciona o preço unitário (base + 5)
        $medicines->transform(function ($medicine) {
            $medicine->unit_price = $medicine->price + 5;
            return $medicine;
        });
        return view('system.sale.index', ['medicines' => $medicines,  'sellerId' => $user->id,]);
    }
}
