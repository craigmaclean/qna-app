<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'craigmaclean1@gmail.com'], // Unique identifier
            [
                'first_name' => 'Craig',
                'last_name' => 'Maclean',
                'password' => Hash::make('craigcraig'), // Use a strong password
                'phone' => '1234567890',
                'position' => 'Admin',
            ]
        );
    }
}
