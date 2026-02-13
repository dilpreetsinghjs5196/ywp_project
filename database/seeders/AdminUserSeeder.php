<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Roles
        $adminRole = \App\Models\Role::firstOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Admin', 'description' => 'Super Administrator']
        );

        \App\Models\Role::firstOrCreate(
            ['slug' => 'user'],
            ['name' => 'User', 'description' => 'Regular User']
        );

        \App\Models\Role::firstOrCreate(
            ['slug' => 'therapist'],
            ['name' => 'Therapist', 'description' => 'Healthcare Professional']
        );

        // 2. Create or Find the Admin User
        $admin = \App\Models\User::firstOrCreate(
            ['email' => 'akash@yourewonderfulproject.org'],
            [
                'name' => 'Akash Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password123'), // Default password
            ]
        );

        // 3. Assign the Admin Role
        $admin->roles()->syncWithoutDetaching([$adminRole->id]);

        $this->command->info('Admin user created/updated and role assigned successfully!');
    }
}
