<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = UserRole::query()->where('role', UserRole::ROLE_ADMIN)->firstOrFail();
        $userRole = UserRole::query()->where('role', UserRole::ROLE_USER)->firstOrFail();


        User::insert([
            [
                'name' => 'test',
                'email' => 'test@example.com',
                'user_role_id' => $userRole->id,
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'test2',
                'email' => 'test2@example.com',
                'user_role_id' => $userRole->id,
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'user_role_id' => $adminRole->id,
                'password' => Hash::make('123'),
            ],
        ]);
    }
}
