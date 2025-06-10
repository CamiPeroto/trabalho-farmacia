<?php
namespace Database\Seeders;

use App\Models\ActiveIngredient;
use Illuminate\Database\Seeder;

class ActiveIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredients = [
            [
                'name'        => 'Paracetamol',
                'description' => 'Analgésico e antipirético usado para aliviar dores e febre.',
            ],
            [
                'name'        => 'Ibuprofeno',
                'description' => 'Anti-inflamatório não esteroidal (AINE) para dor e inflamação.',
            ],
            [
                'name'        => 'Amoxicilina',
                'description' => 'Antibiótico penicilínico usado para tratar infecções bacterianas.',
            ],
        ];

        foreach ($ingredients as $ingredient) {
            // Verifica se já existe antes de criar
            if (! ActiveIngredient::where('name', $ingredient['name'])->first()) {
                ActiveIngredient::create($ingredient);
            }
        }
    }
}
