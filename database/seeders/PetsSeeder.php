<?php

namespace Database\Seeders;

use App\Models\Pet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pets = [
            [
                'client_id'   => 1,
                'species_id'  => 1,
                'name'        => 'Rex',
                'race'        => 'Labrador',
                'age'         => '3',
                'weight'      => '25kg',
                'description' => 'Cachorro amigável e brincalhão',
            ],
            [
                'client_id'   => 2,
                'species_id'  => 2,
                'name'        => 'Luna',
                'race'        => 'Siamês',
                'age'         => '2',
                'weight'      => '5kg',
                'description' => 'Gata calma e carinhosa',
            ],
            [
                'client_id'   => 3,
                'species_id'  => 1,
                'name'        => 'Bolt',
                'race'        => 'Pastor Alemão',
                'age'         => '4',
                'weight'      => '30kg',
                'description' => 'Cachorro protetor e enérgico',
            ],
        ];

        foreach ($pets as $data) {
            if (!Pet::where('name', $data['name'])
                ->where('client_id', $data['client_id'])
                ->first()) {
                
                Pet::create($data);
            }
        }
    }
}
