<?php
namespace App\Http\Controllers;

use App\Http\Requests\IngredientRequest;
use App\Models\ActiveIngredient;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ActiveIngredientController extends Controller
{
    public function index()
    {
        $ingredients = ActiveIngredient::all();
        return view('system.active-ingredient.index', ['ingredients' => $ingredients ]);
    }

    public function store(IngredientRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        try {
            ActiveIngredient::create([
                'name'        => $request->name,
                'description' => $request->description,
            ]);
            DB::commit();

            return redirect()->route('ingredient.index', )
                ->with('success', 'Principio ativo cadastrado com sucesso!');

        } catch (Exception $e) {
            DB::rollBack();
             Log::notice('Principio ativo não cadastrado.', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Principio ativo não cadastrado');

        }
    }

    public function edit(ActiveIngredient $ingredient){
       
        //Carregar view 
        return view('system.active-ingredient.index', ['ingredient' => $ingredient ]);
    }
    
    public function update(IngredientRequest $request, ActiveIngredient $ingredient)
    {
        $request->validated();

        DB::beginTransaction();

        try {

            $ingredient->update([
                'name'        => $request->name,
                'description' => $request->description,

            ]);

            DB::commit();

            Log::info('Curso editado.', ['course_id' => $ingredient->id]);

            return redirect()->route('ingredient.index')
                ->with('success', 'Principio ativo editado com sucesso!');
        } catch (Exception $e) {

            DB::rollBack();

            Log::notice('Principio ativo não editado.', ['error' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Principio ativo não editado!');
        }
    }

    public function destroy(ActiveIngredient $ingredient)
    {

        try {

            $ingredient->delete();

            Log::info('Principio ativo apagado.', ['ingredient' => $ingredient->id]);

            return redirect()->route('ingredient.index')->with('success', 'Principio ativo excluído com sucesso!');

        } catch (Exception $e) {

            Log::info('Principio ativo não apagado.', ['error' => $e->getMessage()]);

            return redirect()->route('ingredient.index')
            ->with('error', 'Principio ativo não foi excluído!');

        }

    }

}
