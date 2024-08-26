<?php

namespace Database\Seeders;

use App\Models\User;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserRole::insert([
            ['role' => 'admin'],
            ['role' => 'user'],
        ]);
    }
}
