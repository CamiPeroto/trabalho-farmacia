<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promotion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PromotionController extends Controller
{
    public function index()
    {
        $branchId = Auth::user()->branch_id;

        $promotions = Promotion::whereHas('product.stock', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })->with('product')->paginate(10);

        return view('system.promotion.index', ['promotions' => $promotions]);
    }
    public function create()
    {
        $branchId = Auth::user()->branch_id;

        $products = Product::whereHas('stock', function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        })->with(['stock' => function ($query) use ($branchId) {
            $query->where('branch_id', $branchId);
        }])->get();

        foreach ($products as $product) {
            $latestStock                     = $product->stock->sortByDesc('entry_date')->first();
            $product->min_promotional_price = $latestStock ? $latestStock->unitary_price * 1.10 : 0;
        }

        return view('system.promotion.create', ['products' => $products]);
    }

    public function store(Request $request)
    {
        if ($request->has('promotional_price')) {
        $request->merge([
            'promotional_price' => str_replace(',', '.', $request->promotional_price),
        ]);
    }

        $request->validate([
            'product_id'       => 'required|exists:products,id',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',
            'promotional_price' => 'required|numeric|min:0',
        ]);

        $product = Product::with('species')->find($request->product_id);
        $branchId = Auth::user()->branch_id;

        // Verifica preço mínimo baseado no valor de compra (estoque mais recente)
        $latestStock = $product->stock()->where('branch_id', $branchId)->latest('entry_date')->first();

        if (! $latestStock) {
            return back()->with('error', 'Este produto não possui estoque registrado na sua filial.');
        }

        $minPrice = $latestStock->unitary_price * 1.10;

        if ($request->promotional_price < $minPrice) {
            return back()->with('error', 'O preço promocional não pode ser inferior ao valor de compra + 10%.');
        }

        Promotion::create($request->all());

        return redirect()->route('promotion.index')->with('success', 'Promoção cadastrada com sucesso.');
    }

    public function edit(Promotion $promotion)
    {
        $products = Product::with('stock')->get();

        foreach ($products as $product) {
            $latestStock                     = $product->stock->sortByDesc('entry_date')->first();
            $product->min_promotional_price = $latestStock ? $latestStock->unitary_price * 1.10 : 0;
        }
        return view('system.promotion.edit', [
            'promotion' => $promotion,
            'products' => $products,
        ]);
    }

    public function update(Request $request, Promotion $promotion)
    {
      if ($request->has('promotional_price')) {
        $request->merge([
            'promotional_price' => str_replace(',', '.', trim($request->promotional_price)),
        ]);
    }  

        $request->validate([
            'promotional_price' => 'required|numeric|min:0',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',
        ]);

        $product = $promotion->product()->with('species')->first();


        $latestStock = $product->stock()->latest('entry_date')->first();

        if (! $latestStock) {
            return back()->with('error', 'Este produto não possui estoque registrado.');
        }

        $minPrice = $latestStock->unitary_price * 1.10;

        if ($request->promotional_price < $minPrice) {
            return back()->with('error', 'O preço promocional não pode ser inferior ao valor de compra + 10%.');
        }
        $promotion->update([
            'start_date'        => $request->start_date,
            'end_date'          => $request->end_date,
            'promotional_price' => $request->promotional_price,
        ]);

        return redirect()->route('promotion.index')->with('success', 'Promoção atualizada com sucesso.');
    }

    public function destroy(Promotion $promotion)
    {

        try {

            $promotion->delete();

            return redirect()->route('promotion.index')->with('success', 'Promoção excluído com sucesso!');

        } catch (Exception $e) {

            Log::info('Promoção não apagada.', ['error' => $e->getMessage()]);

            return redirect()->route('promotion.index')
                ->with('error', 'Promoção não foi excluída!');

        }

    }
}
