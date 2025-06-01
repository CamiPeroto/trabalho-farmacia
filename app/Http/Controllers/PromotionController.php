<?php
namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Promotion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::with('medicine')->get();

        return view('system.promotion.index', ['promotions' => $promotions]);
    }
    public function create()
    {
        $medicines = Medicine::with('stock')->get();

        foreach ($medicines as $medicine) {
            $latestStock                     = $medicine->stock->sortByDesc('entry_date')->first();
            $medicine->min_promotional_price = $latestStock ? $latestStock->unitary_price * 1.10 : 0;
        }

        return view('system.promotion.create', ['medicines' => $medicines]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicine_id'       => 'required|exists:medicines,id',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',
            'promotional_price' => 'required|numeric|min:0',
        ]);

        $medicine = Medicine::with('activeIngredient')->find($request->medicine_id);

        // 1. Verifica se já há promoção ativa com mesmo princípio ativo
        $activeIngredientId = $medicine->active_ingredient_id;

        $alreadyInPromotion = Promotion::whereHas('medicine', function ($query) use ($activeIngredientId) {
            $query->where('active_ingredient_id', $activeIngredientId);
        })
            ->where('end_date', '>=', now())
            ->exists();

        if ($alreadyInPromotion) {
            return back()->with('error', 'Já existe um medicamento com o mesmo princípio ativo em promoção.');
        }

        // 2. Verifica preço mínimo baseado no valor de compra (estoque mais recente)
        $latestStock = $medicine->stock()->latest('entry_date')->first();

        if (! $latestStock) {
            return back()->with('error', 'Este medicamento não possui estoque registrado.');
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
        $request->validate([
            'promotional_price' => 'required|numeric|min:0',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',
        ]);

        $medicine = $promotion->medicine()->with('activeIngredient')->first();

        // Verifica se há outra promoção com o mesmo princípio ativo em andamento (excluindo a atual)
        $activeIngredientId = $medicine->active_ingredient_id;

        $alreadyInPromotion = Promotion::whereHas('medicine', function ($query) use ($activeIngredientId) {
            $query->where('active_ingredient_id', $activeIngredientId);
        })
            ->where('id', '!=', $promotion->id)
            ->where('end_date', '>=', now())
            ->exists();

        if ($alreadyInPromotion) {
            return back()->with('error', 'Já existe outro medicamento com o mesmo princípio ativo em promoção.');
        }

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
