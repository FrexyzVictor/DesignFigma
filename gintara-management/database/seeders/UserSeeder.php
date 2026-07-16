<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


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
}
