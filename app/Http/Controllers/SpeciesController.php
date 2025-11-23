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

            return redirect()->route('species.index')->with('success', 'Principio ativo cadastrado com sucesso!');

        } catch (Exception $e) {
            DB::rollBack();
             Log::notice('Principio ativo não cadastrado.', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Principio ativo não cadastrado');

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
                ->with('success', 'Principio ativo editado com sucesso!');
        } catch (Exception $e) {

            DB::rollBack();

            Log::notice('Principio ativo não editado.', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Principio ativo não editado!');
        }
    }

    public function destroy(Species $species)
    {

        try {

            $species->delete();

            Log::info('Principio ativo apagado.', ['species' => $species->id]);

            return redirect()->route('species.index')->with('success', 'Principio ativo excluído com sucesso!');

        } catch (Exception $e) {

            Log::info('Principio ativo não apagado.', ['error' => $e->getMessage()]);

            return redirect()->route('species.index')
            ->with('error', 'Principio ativo não foi excluído!');

        }

    }

}
