<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'test',
            'email' => 'test@example.com',
            'user_role_id' => '2',
            'password' => '123',
        ]);
    }
}
