<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'name'         => 'Rafael Silva',
                'email'        => 'rafael.silva@example.com',
                'cpf'          => '123.456.789-00',
                'phone_number' => '42999999999',
            ],
            [
                'name'         => 'Ana Souza',
                'email'        => 'ana.souza@example.com',
                'cpf'          => '987.654.321-00',
                'phone_number' => '42988888888',
            ],
            [
                'name'         => 'Carlos Pereira',
                'email'        => 'carlos.pereira@example.com',
                'cpf'          => '111.222.333-44',
                'phone_number' => '42977777777',
            ],
        ];

        foreach ($clients as $data) {
            if (!Client::where('cpf', $data['cpf'])->first()) {
                Client::create($data);
            }
        }
    }
}
