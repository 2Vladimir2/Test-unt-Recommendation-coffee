<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
