<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
     {
        $drugstoreId = 1;

        $products = [
            [
                'fantasy_name' => 'Paracetamol- 500mg',
                'price' => 10.50,
                'type' => 'Comprimido',
                'form' => 'Oral',
                'dosage' => '500mg',
                'maker' => 'OMS',
                'quantity' => 100,
                'description' => 'Analgésico e antipirético.',
                'active_ingredient_id' => 1,
                'image' => 'assets/img/paracetamol.jpg'
            ],
            [
                'fantasy_name' => 'Ibuprofeno - 200mg',
                'price' => 15.00,
                'type' => 'Comprimido',
                'form' => 'Oral',
                'dosage' => '200mg',
                'maker' => 'Farmaceutica Y',
                'quantity' => 50,
                'description' => 'Anti-inflamatório.',
                'active_ingredient_id' => 2,
                'image' => 'assets/img/ibuprofeno.png'
            ],
            [
                'fantasy_name' => 'Amoxicilina- 250mg',
                'price' => 25.00,
                'type' => 'Cápsula',
                'form' => 'Oral',
                'dosage' => '250mg',
                'maker' => 'Farmaceutica Z',
                'quantity' => 200,
                'description' => 'Antibiótico penicilínico.',
                'active_ingredient_id' => 3,
                'image' => 'assets/img/amoxilina.png'
            ],
            [
                'fantasy_name' => 'Dorflex - 36 Comprimidos',
                'price' => 20.00,
                'type' => 'Comprimido',
                'form' => 'Oral',
                'dosage' => '250mg',
                'maker' => 'Sanofi',
                'quantity' => 200,
                'description' => 'Relaxante Muscular.',
                'active_ingredient_id' => 3,
                'image' => 'assets/img/dorflex.png'
            ],
              [
                'fantasy_name' => 'Agemoxi - 100ml',
                'price' => 30.00,
                'type' => 'Solução Injetável',
                'form' => 'Oral',
                'dosage' => '100ml',
                'maker' => 'Sanofi',
                'quantity' => 100,
                'description' => 'Para aliviar a dor de dente.',
                'active_ingredient_id' => 3,
                'image' => 'assets/img/agemoxi.png'
            ],

        ];

        DB::beginTransaction();

        try {
            foreach ($products as $product) {
                // Verifica se já existe pelo nome fantasia
                if (!Medicine::where('fantasy_name', $product['fantasy_name'])->exists()) {
                    $medicine = Medicine::create($product);

                    Stock::create([
                        'medicine_id'     => $medicine->id,
                        'quantity'        => $medicine->quantity,
                        'unitary_price'   => $medicine->price,
                        'entry_date'      => Carbon::now()->toDateString(),
                        'expiration_date' => Carbon::now()->addYears(2)->toDateString(),
                        'drugstore_id'    => $drugstoreId,
                    ]);

                    Log::info('Produto e estoque criados: ' . $medicine->fantasy_name);
                } else {
                    Log::info('Produto já existe, pulando: ' . $product['fantasy_name']);
                }
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar produtos: ' . $e->getMessage());
        }
    }

}
