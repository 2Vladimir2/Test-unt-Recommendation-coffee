<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'id' => 1,
            'name' => 'Тестовый пользователь',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // или Hash::make('password')
        ]);
    }
}
