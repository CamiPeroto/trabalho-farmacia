<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pet;
use App\Models\Client;
use App\Models\Species;

class PetsSeeder extends Seeder
{
    public function run()
    {
        $clients = Client::all();
        $species = Species::all();
        
        // Vamos criar alguns pets aleatórios
        foreach ($clients as $index => $client) {
            $speciesItem = $species->random(); // pega uma espécie aleatória
            Pet::create([
                'name'       => 'Pet ' . ($index + 1),
                'species_id' => $speciesItem->id,
                'race'       => 'Raça ' . ($index + 1),
                'age'        => ($index + 1) . ' anos',
                'weight'     => rand(2, 15) . ' kg',
                'description'=> 'Descrição do pet ' . ($index + 1),
                'client_id'  => $client->id,
            ]);
        }
    }
}
