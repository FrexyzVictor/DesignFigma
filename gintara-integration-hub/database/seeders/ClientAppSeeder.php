<?php

namespace Database\Seeders;

use App\Models\ClientApp;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClientAppSeeder extends Seeder
{
    public function run(): void
    {
        $apps = ['management', 'billing', 'pulseboard', 'wifikula'];

        foreach ($apps as $app) {
            ClientApp::updateOrCreate(
                ['app_name' => $app],
                [
                    'api_key'    => 'key-' . $app . '-' . Str::random(8),
                    'api_secret' => Str::random(32),
                    'is_active'  => true,
                ]
            );
        }
    }
}