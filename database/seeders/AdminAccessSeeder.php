<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminAccessSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleAndPermissionSeeder::class);

        $user = User::updateOrCreate(
            ['email' => '71993692@continental.edu.pe'],
            [
                'name' => 'Giancarlo Guerreros Cordova',
                'password' => Hash::make('71993692'),
                'email_verified_at' => now(),
                'is_admin' => true,
            ],
        );

        $adminRole = Role::where('name', 'admin')->firstOrFail();

        if (! $user->roles()->where('role_id', $adminRole->id)->exists()) {
            $user->roles()->attach($adminRole->id);
        }
    }
}
