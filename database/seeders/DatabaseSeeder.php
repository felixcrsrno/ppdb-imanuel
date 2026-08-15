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
            ['email' => 'admin@imanuel.sch.id'],
            [
                'name' => 'Admin Yayasan Imanuel',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'panitia@imanuel.sch.id'],
            [
                'name' => 'Panitia PPDB 2026',
                'password' => Hash::make('password'),
                'role' => 'panitia',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'pendaftar@gmail.com'],
            [
                'name' => 'Calon Pendaftar Demo',
                'password' => Hash::make('password'),
                'role' => 'pendaftar',
                'email_verified_at' => now(),
            ]
        );
    }
}

