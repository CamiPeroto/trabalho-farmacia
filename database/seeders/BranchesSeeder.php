<?php

namespace Database\Seeders;

use App\Models\Branches;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         if(!Branches::where('name', 'Filial PG')->first()){
            Branches::create([
                'name' => 'Filial PG',
                'location' => 'Ponta Grossa - PR',
                'status' =>true,
            ]);
        }
         if(!Branches::where('name', 'Filial CBI')->first()){
            Branches::create([
                'name' => 'Filial CBI',
                'location' => 'Carambeí - PR',
                'status' =>true,
            ]);
        }
    }
}
