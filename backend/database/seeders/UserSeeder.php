<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Utilizador Administrador
        User::create([
            'name'     => 'Administrador DriveOn',
            'email'    => 'admin@driveon.com',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        // 2. Cliente 1
        User::create([
            'name'     => 'Larissa Silva',
            'email'    => 'larissa@email.com',
            'password' => Hash::make('password123'),
            'role'     => 'client',
        ]);

        // 3. Cliente 2
        User::create([
            'name'     => 'Carlos Eduardo',
            'email'    => 'carlos@email.com',
            'password' => Hash::make('password123'),
            'role'     => 'client',
        ]);

        // 4. Cliente 3
        User::create([
            'name'     => 'Fernanda Souza',
            'email'    => 'fernanda@email.com',
            'password' => Hash::make('password123'),
            'role'     => 'client',
        ]);
    }
}