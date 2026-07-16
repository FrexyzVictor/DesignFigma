<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create client apps for integration hub
        DB::table('client_apps')->insert([
            [
                'app_name' => 'gintara-management',
                'api_key' => 'key_management_' . hash('sha256', 'gintara-management'),
                'api_secret' => hash('sha256', 'secret_management_gintara'),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'app_name' => 'gintara-billing',
                'api_key' => 'key_billing_' . hash('sha256', 'gintara-billing'),
                'api_secret' => hash('sha256', 'secret_billing_gintara'),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'app_name' => 'gintara-integration-hub',
                'api_key' => 'key_hub_' . hash('sha256', 'gintara-integration-hub'),
                'api_secret' => hash('sha256', 'secret_hub_gintara'),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
