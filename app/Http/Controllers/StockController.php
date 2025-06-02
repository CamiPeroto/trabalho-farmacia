<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('medicine')->get();
        return view('system.stock.index', ['stocks' => $stocks]);
    }
    public function edit(Stock $stock)
    {
        $medicine = $stock->medicine;

        return view('system.stock.edit', [
            'stock'    => $stock,
            'medicine' => $medicine,
        ]);
    }

    public function update(Request $request, Stock $stock)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'unitary_price'   => 'required|numeric|min:0',
            'quantity'        => 'required|integer|min:0',
            'expiration_date' => 'required|date',
            'is_active'       => 'required|boolean',
        ]);

        // Atualiza os campos do estoque
        $stock->unitary_price   = $validatedData['unitary_price'];
        $stock->quantity        = $validatedData['quantity'];
        $stock->expiration_date = $validatedData['expiration_date'];
        $stock->status          = $validatedData['is_active']; // Atualiza status conforme rádio

        // Salva as alterações no estoque
        $stock->save();

        // Redireciona com sucesso
        return redirect()->route('stock.index')->with('success', 'Estoque atualizado com sucesso!');
    }

}
