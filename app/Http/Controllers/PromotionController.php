<?php
namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Promotion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PromotionController extends Controller
{
    public function index()
    {
        $drugstoreId = Auth::user()->drugstore_id;

        $promotions = Promotion::whereHas('medicine.stock', function ($query) use ($drugstoreId) {
            $query->where('drugstore_id', $drugstoreId);
        })->with('medicine')->get();

        return view('system.promotion.index', ['promotions' => $promotions]);
    }
    public function create()
    {
        $drugstoreId = Auth::user()->drugstore_id;

        $medicines = Medicine::whereHas('stock', function ($query) use ($drugstoreId) {
            $query->where('drugstore_id', $drugstoreId);
        })->with(['stock' => function ($query) use ($drugstoreId) {
            $query->where('drugstore_id', $drugstoreId);
        }])->get();

        foreach ($medicines as $medicine) {
            $latestStock                     = $medicine->stock->sortByDesc('entry_date')->first();
            $medicine->min_promotional_price = $latestStock ? $latestStock->unitary_price * 1.10 : 0;
        }

        return view('system.promotion.create', ['medicines' => $medicines]);
    }

    public function store(Request $request)
    {
        if ($request->has('promotional_price')) {
        $request->merge([
            'promotional_price' => str_replace(',', '.', $request->promotional_price),
        ]);
    }

        $request->validate([
            'medicine_id'       => 'required|exists:medicines,id',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',
            'promotional_price' => 'required|numeric|min:0',
        ]);

        $medicine    = Medicine::with('activeIngredient')->find($request->medicine_id);
        $drugstoreId = Auth::user()->drugstore_id;

        $activeIngredientId = $medicine->active_ingredient_id;

        // Verifica se já há promoção ativa com mesmo princípio ativo NA MESMA FILIAL
        $alreadyInPromotion = Promotion::whereHas('medicine.stock', function ($query) use ($drugstoreId) {
            $query->where('drugstore_id', $drugstoreId);
        })
            ->whereHas('medicine', function ($query) use ($activeIngredientId) {
                $query->where('active_ingredient_id', $activeIngredientId);
            })
            ->where('end_date', '>=', now())
            ->exists();

        if ($alreadyInPromotion) {
            return back()->with('error', 'Já existe um medicamento com o mesmo princípio ativo em promoção nesta filial.');
        }

        // Verifica preço mínimo baseado no valor de compra (estoque mais recente)
        $latestStock = $medicine->stock()->where('drugstore_id', $drugstoreId)->latest('entry_date')->first();

        if (! $latestStock) {
            return back()->with('error', 'Este medicamento não possui estoque registrado na sua filial.');
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
        $medicines = Medicine::with('stock')->get();

        foreach ($medicines as $medicine) {
            $latestStock                     = $medicine->stock->sortByDesc('entry_date')->first();
            $medicine->min_promotional_price = $latestStock ? $latestStock->unitary_price * 1.10 : 0;
        }
        return view('system.promotion.edit', [
            'promotion' => $promotion,
            'medicines' => $medicines,
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

        $medicine = $promotion->medicine()->with('activeIngredient')->first();


        $latestStock = $medicine->stock()->latest('entry_date')->first();

        if (! $latestStock) {
            return back()->with('error', 'Este medicamento não possui estoque registrado.');
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
