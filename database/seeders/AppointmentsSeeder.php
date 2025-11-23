<?php

namespace Database\Seeders;

use App\Models\Appointments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AppointmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointments = [
            [
                'pet_name'     => 'Rex',
                'owner_phone'  => '42999999999',
                'date'         => Carbon::now()->addDays(1)->toDateString(),
                'time'         => '10:00:00',
                'services'     => json_encode(['Banho', 'Tosa']),
                'total_value'  => 120.00,
            ],
            [
                'pet_name'     => 'Luna',
                'owner_phone'  => '42988888888',
                'date'         => Carbon::now()->addDays(2)->toDateString(),
                'time'         => '14:00:00',
                'services'     => json_encode(['Consulta', 'Vacina']),
                'total_value'  => 200.00,
            ],
            [
                'pet_name'     => 'Bolt',
                'owner_phone'  => '42977777777',
                'date'         => Carbon::now()->addDays(3)->toDateString(),
                'time'         => '09:30:00',
                'services'     => json_encode(['Banho']),
                'total_value'  => 50.00,
            ],
        ];

        foreach ($appointments as $data) {
            if (!Appointments::where('pet_name', $data['pet_name'])
                ->where('owner_phone', $data['owner_phone'])
                ->where('date', $data['date'])
                ->where('time', $data['time'])
                ->first()) {
                
                Appointments::create($data);
            }
        }
    }
}
