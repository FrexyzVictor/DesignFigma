<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    User::updateOrCreate(
        ['email' => 'superadmin@gintara.test'],
        [
            'name' => 'Super Admin',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]
    );

    User::updateOrCreate(
        ['email' => 'admin@gintara.test'],
        [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]
    );
}
    public function run(): void
    {
        // Create Super Admin user
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gintara.com',
            'password' => bcrypt('password123'),
            'role' => 'super_admin',
        ]);

        // Create Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gintara.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        // Create additional test Admin
        User::create([
            'name' => 'Admin Two',
            'email' => 'admin2@gintara.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);
    }
}
