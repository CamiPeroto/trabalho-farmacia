<?php
namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! Role::where('name', 'Super Admin')->first()) {
            Role::create([
                'name'       => 'Super Admin',
                'guard_name' => 'web',
            ]);
        }
        if (! Role::where('name', 'Admin')->first()) {
            $admin = Role::create([
                'name'       => 'Admin',
                'guard_name' => 'web',
            ]);
        } else {
            $admin = Role::where('name', 'Admin')->first();
        }
        //Dar permissão para o papel
        $admin->givePermissionTo([

            'index-active-ingredient',
            'create-active-ingredient',
            'update-active-ingredient',
            'destroy-active-ingredient',

            'index-medicine',
            'create-medicine',
            'update-medicine',
            'destroy-medicine',

            'index-promotions',
            'create-promotions',
            'update-promotions',
            'destroy-promotions',

            'index-stock',
            'update-stock',
            'destroy-stock',

            'index-drugstore',
            'index-budget',

            'index-role-permission',
            'update-role-permission',

            'index-role',
            'create-role',
            'edit-role',
            'destroy-role',

        ]);
        //Remover a permissão de acesso
        // $admin->revokePermissionTo([
        //     'update-role-permission',
        // ]);

        if (! Role::where('name', 'Funcionário')->first()) {
            $employee = Role::create([
                'name'       => 'Funcionário',
                'guard_name' => 'web',
            ]);

        } else {
            $employee = Role::where('name', 'Funcionário')->first();
        }
        $employee->givePermissionTo([
            'index-active-ingredient',
            'create-active-ingredient',
            'update-active-ingredient',
            'destroy-active-ingredient',

            'index-medicine',
            'create-medicine',
            'update-medicine',
            'destroy-medicine',

            'index-promotions',
            'create-promotions',
            'update-promotions',
            'destroy-promotions',

        ]);

        if (! Role::where('name', 'Cliente')->first()) {
            $client = Role::create([
                'name'       => 'Cliente',
                'guard_name' => 'web',
            ]);
        } else {
            $client = Role::where('name', 'Cliente')->first();
        }

    }
}
