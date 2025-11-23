<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
     {
        $branchId = 1;

        $products = [
            [
                'species_id'   => 1, // Ex: Canino
                'name'         => 'Ração Special Dog - 15Kg',
                'shape'        => 'Saco',
                'weight'       => '15kg',
                'type'         => 'Alimento',
                'maker'        => 'SpecialDog',
                'code_product' => 'ALIM-001',
                'price'        => 189.90,
                'quantity'     => 50,
                'image'        => 'assets/img/racao.png',
            ],
            [
                'species_id'   => 2, // Ex: Felino
                'name'         => 'Whiskas Sachê',
                'shape'        => 'Embalachem',
                'weight'       => '40g',
                'type'         => 'Alimento',
                'maker'        => 'Whiskas',
                'code_product' => 'HIG-002',
                'price'        => 29.90,
                'quantity'     => 120,
                'image'        => 'assets/img/whiskas.png',
            ],
            [
                'species_id'   => 1,
                'name'         => 'Shampoo Anti-Pulgas 500ml',
                'shape'        => 'Frasco',
                'weight'       => '500ml',
                'type'         => 'Higiene',
                'maker'        => 'PetCare',
                'code_product' => 'HIG-003',
                'price'        => 22.50,
                'quantity'     => 80,
                'image'        => 'assets/img/shampoo.png',
            ],
            [
                'species_id'   => 3, 
                'name'         => 'Antipulgas Bravect0',
                'shape'        => 'Comprimidio',
                'weight'       => '50g',
                'type'         => 'Remédop',
                'maker'        => 'Bravecto',
                'code_product' => 'REM-001',
                'price'        => 18.90,
                'quantity'     => 100,
                'image'        => 'assets/img/antipulgas.png',
            ],
        ];

        DB::beginTransaction();

        try {
            foreach ($products as $product) {

                // Evita duplicar pelo nome
                if (!Product::where('name', $product['name'])->exists()) {

                    Product::create($product);

                    Log::info('Produto criado: ' . $product['name']);

                } else {
                    Log::info('Produto já existe, pulando: ' . $product['name']);
                }
            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Erro ao criar produtos: ' . $e->getMessage());
        }
    }
}
