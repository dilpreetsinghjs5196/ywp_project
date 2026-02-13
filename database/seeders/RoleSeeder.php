<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = \App\Models\Role::firstOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Admin', 'description' => 'Super Administrator']
        );

        \App\Models\Role::firstOrCreate(
            ['slug' => 'user'],
            ['name' => 'User', 'description' => 'Regular User']
        );

        $user = \App\Models\User::where('email', 'akash@yourewonderfulproject.org')->first();
        if ($user) {
            $user->roles()->syncWithoutDetaching([$adminRole->id]);
        }
    }
}
