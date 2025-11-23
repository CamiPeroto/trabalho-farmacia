<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Species;
use App\Models\Client;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PetsController extends Controller
{
    public function index()
    {
        $branchId = Auth::user()->branch_id;

        $pets = Pet::with(['client', 'species'])->paginate(10);

        return view('system.pets.index', compact('pets'));
    }

    public function create()
    {
        $species = Species::all();
        return view('system.pets.create', compact('species'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'species_id'        => 'required|exists:species,id',
            'race'              => 'required|string|max:255',
            'age'               => 'required|string|max:50',
            'weight'            => 'required|string|max:20',
            'description'       => 'nullable|string',
            'client_name'       => 'required|string|max:255',
            'client_phone'      => 'required|string|max:20',
            'client_cpf'        => 'required|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            $client = Client::create([
                'name'          => $request->client_name,
                'phone_number'  => $request->client_phone,
                'cpf'           => $request->client_cpf,
            ]);

            Pet::create([
                'name'          => $request->name,
                'species_id'    => $request->species_id,
                'race'          => $request->race,
                'age'           => $request->age,
                'weight'        => $request->weight,
                'description'   => $request->description,
                'client_id'     => $client->id,
            ]);

            DB::commit();
            return redirect()->route('pets.index')->with('success', 'Pet cadastrado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Erro ao cadastrar pet: ' . $e->getMessage());
        }
    }

    public function edit(Pet $pet)
    {
        $species = Species::all();
        return view('system.pets.edit', compact('pet', 'species'));
    }

    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'species_id'  => 'required|exists:species,id',
            'race'        => 'required|string|max:255',
            'age'         => 'required|string|max:50',
            'weight'      => 'required|string|max:20',
            'description' => 'nullable|string',
            'client_name' => 'required|string|max:255',
            'client_phone'=> 'required|string|max:20',
            'client_cpf'  => 'required|string|max:20',
        ]);

        DB::beginTransaction();
        try {
            // Atualiza cliente
            $pet->client->update([
                'name'         => $request->client_name,
                'phone_number' => $request->client_phone,
                'cpf'          => $request->client_cpf,
                'email'        => $request->client_email ?? null,
            ]);

            // Atualiza pet
            $pet->update([
                'name'       => $request->name,
                'species_id' => $request->species_id,
                'race'       => $request->race,
                'age'        => $request->age,
                'weight'     => $request->weight,
                'description'=> $request->description,
            ]);

            DB::commit();
            return redirect()->route('pets.index')->with('success', 'Pet atualizado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Erro ao atualizar pet: ' . $e->getMessage());
        }
    }

    public function destroy(Pet $pet)
    {
        try {
            $pet->delete();
            return redirect()->route('pets.index')->with('success', 'Pet excluído com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('pets.index')->with('error', 'Erro ao excluir pet: ' . $e->getMessage());
        }
    }  
}
