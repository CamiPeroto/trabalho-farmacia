<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         if(!Branch::where('name', 'Filial PG')->first()){
            Branch::create([
                'name' => 'Filial PG',
                'location' => 'Ponta Grossa - PR',
                'status' =>true,
            ]);
        }
         if(!Branch::where('name', 'Filial CBI')->first()){
            Branch::create([
                'name' => 'Filial CBI',
                'location' => 'Carambeí - PR',
                'status' =>true,
            ]);
        }
    }
}
