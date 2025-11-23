<?php
namespace Database\Seeders;

use App\Models\Species;
use Illuminate\Database\Seeder;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $species = [
            [
                'name'        => 'Canino',
                'description' => 'Animais da espécie canina. Ex: cães domésticos.',
            ],
            [
                'name'        => 'Felino',
                'description' => 'Animais da espécie felina. Ex: gatos domésticos.',
            ],
            [
                'name'        => 'Aves',
                'description' => 'Diversos tipos de aves domésticas.',
            ],
            [
                'name'        => 'Outros',
                'description' => 'Espécies diversas.',
            ],
        ];

        foreach ($species as $specie) {
            // evita duplicar
            if (! Species::where('name', $specie['name'])->exists()) {
                Species::create($specie);
            }
        }
    }
}
