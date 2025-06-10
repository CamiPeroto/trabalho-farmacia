<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            DrugstoreSeeder::class,
            UserSeeder::class,
            ActiveIngredientSeeder::class,
            MedicineSeeder::class,

        ]);
    }
}
