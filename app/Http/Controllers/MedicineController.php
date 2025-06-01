<?php
namespace App\Http\Controllers;

use App\Http\Requests\MedicineRequest;
use App\Models\ActiveIngredient;
use App\Models\Medicine;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::all();
        return view('system.medicines.index', ['medicines' => $medicines]);
    }
    public function create()
    {
        $ingredients = ActiveIngredient::all();
        return view('system.medicines.create', ['ingredients' => $ingredients]);
    }
    
    public function store(MedicineRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            $imagePath = null;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('medicines', 'public'); // pasta storage/app/public/medicines
            } else {
                $imagePath = null;
            }
            Medicine::create([
                'fantasy_name'         => $request->fantasy_name,
                'type'                 => $request->type,
                'form'                 => $request->form,
                'dosage'               => $request->dosage,
                'maker'                => $request->maker,
                'description'          => $request->description,
                'active_ingredient_id' => $request->active_ingredient_id,
                'image'                => $imagePath,
            ]);
            DB::commit();

            return redirect()->route('medicine.index', )
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
        return view('system.medicines.edit', [  'medicine' => $medicine,'ingredients' => $ingredients]);
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
