<?php
namespace App\Http\Controllers;

use App\Models\Branch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BranchesController extends Controller
{
    public function index()
    {
        $branches = Branch::paginate(10);
        return view('system.branches.index', ['branches' => $branches]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:50|unique:branches,name',
            'location' => 'required|string|max:50',
        ]);

        DB::beginTransaction();

        try {
            Branch::create([
                'name'     => $validated['name'],
                'location' => $validated['location'],
                'status'   => true,
            ]);
            DB::commit();

            return redirect()->route('branches.index', )->with('success', 'Filial cadastrada com sucesso!');

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
            'name'     => 'required|string|max:50|unique:branchs,name,' . $id,
            'location' => 'required|string|max:50',
            'status'   => 'required|boolean',
        ]);

        DB::beginTransaction();

        try {
            $branch = Branch::findOrFail($id);

            $branch->update([
                'name'     => $validated['name'],
                'location' => $validated['location'],
                'status'   => $validated['status'],
            ]);

            DB::commit();

            return redirect()->route('branches.index')
                ->with('success', 'Filial atualizada com sucesso!');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Erro ao atualizar filial.', ['error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Erro ao atualizar filial');
        }
    }
    public function destroy(Branch $branch)
    {
        try {
            $branch->delete();

            Log::info('Filial apagada.', ['branch_id' => $branch->id]);

            return redirect()->route('branches.index')->with('success', 'Filial excluída com sucesso!');

        } catch (Exception $e) {
            Log::error('Erro ao excluir filial.', ['error' => $e->getMessage()]);

            return redirect()->route('branches.index')->with('error', 'Filial não foi excluída!');
        }
    }

}
