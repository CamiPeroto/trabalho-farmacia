<?php
namespace App\Http\Controllers;

use App\Models\Drugstore;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DrugStoreController extends Controller
{
    public function index()
    {
        $drugstores = Drugstore::all();
        return view('system.drugstore.index', ['drugstores' => $drugstores]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:50|unique:drugstores,name',
            'location' => 'required|string|max:50',
        ]);

        DB::beginTransaction();

        try {
            Drugstore::create([
                'name'     => $validated['name'],
                'location' => $validated['location'],
                'status'   => true,
            ]);
            DB::commit();

            return redirect()->route('drugstore.index', )
                ->with('success', 'Filial cadastrada com sucesso!');

        } catch (Exception $e) {
            DB::rollBack();
            Log::notice('Filial não cadastrada.', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Filial não cadastrada');

        }
    }
    public function update(Request $request, $id)
    {
        Log::info('Status recebido:', ['status' => $request->input('status')]);
        $validated = $request->validate([
            'name'     => 'required|string|max:50|unique:drugstores,name,' . $id,
            'location' => 'required|string|max:50',
            'status'   => 'required|boolean',
        ]);

        DB::beginTransaction();

        try {
            $drugstore = Drugstore::findOrFail($id);

            $drugstore->update([
                'name'     => $validated['name'],
                'location' => $validated['location'],
                'status'   => $validated['status'],
            ]);

            DB::commit();

            return redirect()->route('drugstore.index')
                ->with('success', 'Filial atualizada com sucesso!');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar filial.', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Erro ao atualizar filial');
        }
    }
    public function destroy(Drugstore $drugstore)
    {
        try {
            $drugstore->delete();

            Log::info('Filial apagada.', ['drugstore_id' => $drugstore->id]);

            return redirect()->route('drugstore.index')
                ->with('success', 'Filial excluída com sucesso!');

        } catch (Exception $e) {
            Log::error('Erro ao excluir filial.', ['error' => $e->getMessage()]);

            return redirect()->route('drugstore.index')
                ->with('error', 'Filial não foi excluída!');
        }
    }

}
