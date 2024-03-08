<?php

namespace Database\Seeders;

use App\Constants\UserRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create(['name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'is_admin' => UserRoles::IS_ADMIN
        ]);
    }
}
