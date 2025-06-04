<?php

namespace Database\Seeders;

use App\Models\Drugstore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DrugstoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         if(!Drugstore::where('name', 'Filial PG')->first()){
            Drugstore::create([
                'name' => 'Filial PG',
                'location' => 'Ponta Grossa - PR',
                'status' =>true,
            ]);
        }
         if(!Drugstore::where('name', 'Filial CBI')->first()){
            Drugstore::create([
                'name' => 'Filial CBI',
                'location' => 'Carambeí - PR',
                'status' =>true,
            ]);
        }
    }
}
