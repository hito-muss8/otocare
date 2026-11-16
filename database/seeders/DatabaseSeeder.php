<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@otocare.com'],
            [
                'name' => 'Administrator OtoCare',
                'password' => Hash::make('AdminOtoCare123'),
                'role' => 'admin',
                'customer_id' => null,
            ]
        );
    }
}
