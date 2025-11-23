<?php
namespace App\Http\Controllers;

use App\Http\Requests\SpeciesRequest;
use App\Models\Species;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SpeciesController extends Controller
{
    public function index()
    {
        $species = Species::paginate(10);
        return view('system.species.index', ['species' => $species ]);
    }

    public function store(SpeciesRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            Species::create([
                'name'        => $request->name,
                'description' => $request->description,
            ]);
            DB::commit();

            return redirect()->route('species.index')->with('success', 'Espécie cadastrada com sucesso!');

        } catch (Exception $e) {
            DB::rollBack();
             Log::notice('Espécie não cadastrada.', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Espécie não cadastrada');

        }
    }

    public function edit(Species $species){
       
        //Carregar view 
        return view('system.species.index', ['species' => $species ]);
    }
    
    public function update(SpeciesRequest $request, Species $species)
    {
        $request->validated();

        DB::beginTransaction();

        try {

            $species->update([
                'name'        => $request->name,
                'description' => $request->description,

            ]);

            DB::commit();

            Log::info('Curso editado.', ['course_id' => $species->id]);

            return redirect()->route('species.index')
                ->with('success', 'Espécie editada com sucesso!');
        } catch (Exception $e) {

            DB::rollBack();

            Log::notice('Espécie não editada.', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Espécie não editada!');
        }
    }

    public function destroy(Species $species)
    {
        try {

            $species->delete();

            Log::info('Espécie apagada.', ['species' => $species->id]);

            return redirect()->route('species.index')->with('success', 'Espécie excluída com sucesso!');

        } catch (Exception $e) {

            Log::info('Espécie não apagada.', ['error' => $e->getMessage()]);

            return redirect()->route('species.index')
            ->with('error', 'Espécie não foi excluída!');
        }
    }
}
