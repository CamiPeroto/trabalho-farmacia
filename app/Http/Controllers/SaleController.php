<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Comission;
use App\Models\Medicine;
use App\Models\Sale;
use App\Models\Stock;
use Illuminate\Http\Request;
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
        return view('system.sale.index', ['medicines' => $medicines, 'sellerId' => $user->id]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'cpf'       => 'required|string|max:14',
            'medicines' => 'required|array|min:1',
        ]);

        // Busca ou cria cliente pelo CPF
        $client = Client::firstOrCreate(
            ['cpf' => $request->cpf],
            [
                'name'         => 'Cliente sem nome', // Pode ser um padrão, ou você pode pedir nome no form
                'email'        => null,               // Ou algum email padrão, se for nullable
                'phone_number' => null,               // Pode ser null se permitido no banco
            ]
        );

        $totalValue = 0;

        foreach ($request->medicines as $medicineData) {
            if (! isset($medicineData['id']) || ! isset($medicineData['quantity'])) {
                return back()->with('error', 'Dados do produto inválidos.');
            }

            $stock = Stock::where('medicine_id', $medicineData['id'])->first();

            if (! $stock || $stock->quantity < $medicineData['quantity']) {
                return back()->with('error', 'Estoque insuficiente para o produto selecionado.');
            }

            $totalValue += $stock->unitary_price * $medicineData['quantity'];
        }

        $sale = Sale::create([
            'client_id'   => $client->id,
            'sale'        => now(),
            'description' => 'Venda realizada no sistema',
            'total_value' => $totalValue,
        ]);

        foreach ($request->medicines as $medicineData) {
            $stock = Stock::where('medicine_id', $medicineData['id'])->first();

            $stock->quantity -= $medicineData['quantity'];
            $stock->save();

            $sale->products()->create([
                'medicine_id' => $medicineData['id'],
                'quantity'    => $medicineData['quantity'],
                'unit_price'  => $stock->unitary_price,
            ]);
        }

        $commission          = new Comission();
        $commission->user_id = Auth::id();
        $commission->sale_id = $sale->id;
        $commission->value   = $totalValue * 0.05;
        $commission->save();

        return redirect()->route('sale.index')->with('success', 'Venda realizada com sucesso e comissão gerada.');
    }
}
