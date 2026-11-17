<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Cuci Cepat Eksterior Reguler', 'description' => 'Cuci bodi luar & semir ban', 'price' => 30000, 'estimated_duration_minutes' => 25],
            ['name' => 'Cuci Komplit + Hydrophobic Wax', 'description' => 'Cuci luar dalam, vacuum, dan wax pelindung cat', 'price' => 50000, 'estimated_duration_minutes' => 45],
            ['name' => 'Deep Interior Cleansing & Fogging', 'description' => 'Pembersihan jok, karpet, dan antibakteri fogging', 'price' => 120000, 'estimated_duration_minutes' => 60],
            ['name' => 'Signature Full Detailing', 'description' => 'Perawatan total eksterior, interior, dan mesin', 'price' => 250000, 'estimated_duration_minutes' => 120],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
