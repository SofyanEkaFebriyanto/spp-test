<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'password' => 'password',
                'role' => 'admin',
            ]
        );

        \App\Models\User::firstOrCreate(
            ['username' => 'petugas'],
            [
                'name' => 'Petugas SPP',
                'password' => 'password',
                'role' => 'petugas',
            ]
        );
    }
}
