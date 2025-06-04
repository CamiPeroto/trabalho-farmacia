<?php
namespace App\Http\Controllers;

use App\Http\Requests\MedicineRequest;
use App\Models\ActiveIngredient;
use App\Models\Medicine;
use App\Models\Stock;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MedicineController extends Controller
{
    public function index()
    {
        $drugstoreId = Auth::user()->drugstore_id;

        $medicines = Medicine::whereHas('stock', function ($query) use ($drugstoreId) {
            $query->where('drugstore_id', $drugstoreId);
        })->with(['stock' => function ($query) use ($drugstoreId) {
            $query->where('drugstore_id', $drugstoreId);
        }])->get();

        return view('system.medicines.index', ['medicines' => $medicines]);
    }
    public function create()
    {
        $ingredients = ActiveIngredient::all();
        $nextId      = \App\Models\Medicine::max('id') + 1;

        return view('system.medicines.create',
            [
                'ingredients' => $ingredients,
                'nextId'      => $nextId,
            ]);
    }

    public function store(MedicineRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('medicines', 'public')
            : null;

            // Cria o remédio e armazena em $medicine
            $medicine = Medicine::create([
                'fantasy_name'         => $request->fantasy_name,
                'price'                => $request->price,
                'type'                 => $request->type,
                'form'                 => $request->form,
                'dosage'               => $request->dosage,
                'maker'                => $request->maker,
                'quantity'             => $request->quantity,
                'description'          => $request->description,
                'active_ingredient_id' => $request->active_ingredient_id,
                'image'                => $imagePath,
            ]);

            $drugstoreId = Auth::user()->drugstore_id;
            if (! $drugstoreId) {
            }

            // Cria automaticamente o estoque
            Log::info('Criando estoque com drugstore_id', ['drugstore_id' => $drugstoreId]);
            Stock::create([
                'medicine_id'     => $medicine->id,
                'quantity'        => $medicine->quantity,
                'unitary_price'   => $medicine->price,
                'entry_date'      => Carbon::now()->toDateString(),
                'expiration_date' => Carbon::now()->addYears(2)->toDateString(),
                'drugstore_id'    => $drugstoreId,
            ]);

            DB::commit();

            return redirect()->route('medicine.index')
                ->with('success', 'Remédio cadastrado com sucesso!');

        } catch (Exception $e) {
            DB::rollBack();
            Log::notice('Remédio não cadastrado.', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Remédio não cadastrado');
        }
    }

    public function edit(Medicine $medicine)
    {
        $ingredients = ActiveIngredient::all();
        return view('system.medicines.edit', ['medicine' => $medicine, 'ingredients' => $ingredients]);
    }

    public function update(MedicineRequest $request, Medicine $medicine)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            // Se houver nova imagem, armazena e exclui a antiga
            if ($request->hasFile('image')) {
                // Exclui imagem antiga, se existir
                if ($medicine->image && Storage::disk('public')->exists($medicine->image)) {
                    Storage::disk('public')->delete($medicine->image);
                }

                $imagePath = $request->file('image')->store('medicines', 'public');
            } else {
                $imagePath = $medicine->image; // mantém a imagem atual
            }

            // Atualiza os dados
            $medicine->update([
                'fantasy_name'         => $request->fantasy_name,
                'price'                => $request->price,
                'type'                 => $request->type,
                'form'                 => $request->form,
                'dosage'               => $request->dosage,
                'maker'                => $request->maker,
                'description'          => $request->description,
                'active_ingredient_id' => $request->active_ingredient_id,
                'image'                => $imagePath,
            ]);

            DB::commit();

            return redirect()->route('medicine.index')
                ->with('success', 'Remédio atualizado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar remédio.', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Erro ao atualizar o remédio.');
        }
    }
    public function destroy(Medicine $medicine)
    {

        try {

            $totalStock = $medicine->stock()->count();

            // Estoques que são inativos e com quantidade < 3
            $deletableStock = $medicine->stock()
                ->where('status', false)
                ->where('quantity', '<', 3)
                ->count();

            // Se houver algum estoque que não é seguro, bloqueia
            if ($deletableStock !== $totalStock) {
                return redirect()->route('medicine.index')
                    ->with('error', 'Remédio não foi excluído! Estoque ativo ou com quantidade suficiente.');
            }

            // Exclui todos os estoques restantes
            $medicine->stock()->delete();
            $medicine->delete();

            Log::info('Remédio apagado.', ['medicine' => $medicine->id]);

            return redirect()->route('medicine.index')->with('success', 'Remédio excluído com sucesso!');

        } catch (Exception $e) {

            Log::info('Remédio não apagado.', ['error' => $e->getMessage()]);

            return redirect()->route('medicine.index')
                ->with('error', 'Remédio não foi excluído!');

        }

    }

}
