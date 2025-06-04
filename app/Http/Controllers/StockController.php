<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Drugstore;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
         $query = Stock::with(['medicine', 'drugstore']);

    if ($request->has('drugstore')) {
        $query->where('drugstore_id', $request->drugstore);
    }

    $stocks = $query->get();
    $drugstores = Drugstore::orderBy('name')->get();

    return view('system.stock.index', [
        'stocks' => $stocks,
        'drugstores' => $drugstores,
    ]);
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
