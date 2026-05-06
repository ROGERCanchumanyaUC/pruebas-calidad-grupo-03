<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Usuario de prueba',
                'password' => Hash::make('71993692'),
                'email_verified_at' => now(),
            ],
        );

        User::updateOrCreate(
            ['email' => '71993692@continental.edu.pe'],
            [
                'name' => 'Giancarlo Guerreros Cordova',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_admin' => true,
            ],
        );
    }
}
