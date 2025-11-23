<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['title' => 'Listar especies', 'name' => 'index-species'],
            ['title' => 'Criar especies', 'name' => 'create-species'],
            ['title' => 'Editar especies', 'name' => 'update-species'],
            ['title' => 'Apagar especies', 'name' => 'destroy-species'],

            ['title' => 'Listar produtos', 'name' => 'index-products'],
            ['title' => 'Criar produto', 'name' => 'create-products'],
            ['title' => 'Editar produto', 'name' => 'update-products'],
            ['title' => 'Apagar produto', 'name' => 'destroy-products'],

            ['title' => 'Listar promoções', 'name' => 'index-promotions'],
            ['title' => 'Criar promoções', 'name' => 'create-promotions'],
            ['title' => 'Editar promoções', 'name' => 'update-promotions'],
            ['title' => 'Apagar promoções', 'name' => 'destroy-promotions'],

            ['title' => 'Listar estoque', 'name' => 'index-stock'],
            ['title' => 'Editar estoque', 'name' => 'update-stock'],
            ['title' => 'Apagar estoque', 'name' => 'destroy-stock'],

            ['title' => 'Listar filiais', 'name' => 'index-branches'],
            ['title' => 'Listar fornecedores', 'name' => 'index-budget'],

            ['title' => 'Listar papéis', 'name' => 'index-role'],
            ['title' => 'Criar papel', 'name' => 'create-role'],
            ['title' => 'Editar papel', 'name' => 'edit-role'],
            ['title' => 'Apagar papel', 'name' => 'destroy-role'],

            ['title' => 'Listar permissões do papel', 'name' => 'index-role-permission'],
            ['title' => 'Editar permissões do papel', 'name' => 'update-role-permission'],
        ];

        foreach ($permissions as $permission) {
            $existingPermission = Permission::where('name', $permission['name'])->first();

            if (! $existingPermission) {
                Permission::create([
                    'title'      => $permission['title'],
                    'name'       => $permission['name'],
                    'guard_name' => 'web',
                ]);
            }

        }
    }

}
