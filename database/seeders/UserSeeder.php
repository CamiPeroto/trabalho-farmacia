<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! User::where('email', 'camila@gmail.com.br')->first()) {
            User::create([
                'name'     => 'Camila',
                'email'    => 'camila@gmail.com.br',
                'password' => Hash::make('123456a', ['rounds' => 12]),
            ]);
        }

        if (! User::where('email', 'muller@gmail.com.br')->first()) {
            User::create([
                'name'     => 'Muller',
                'email'    => 'muller@gmail.com.br',
                'password' => Hash::make('123456a', ['rounds' => 12]),
            ]);

        }
        if (! User::where('email', 'conrado@gmail.com.br')->first()) {
            User::create([
                'name'     => 'Conrado',
                'email'    => 'conrado@gmail.com.br',
                'password' => Hash::make('123456a', ['rounds' => 12]),
            ]);

        }
        if (! User::where('email', 'rafael@gmail.com.br')->first()) {
            User::create([
                'name'     => 'Rafael',
                'email'    => 'rafael@gmail.com.br',
                'password' => Hash::make('123456a', ['rounds' => 12]),
            ]);

        }
    }
}
