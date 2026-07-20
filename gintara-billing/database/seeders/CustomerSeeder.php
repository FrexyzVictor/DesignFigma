<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test customers with global_ids
        Customer::create([
            'global_id' => 'cust_001',
            'nama' => 'PT. Maju Jaya',
            'telepon' => '021-1234567',
            'status' => 'aktif',
        ]);

        Customer::create([
            'global_id' => 'cust_002',
            'nama' => 'CV. Sukses Mandiri',
            'telepon' => '031-7654321',
            'status' => 'aktif',
        ]);

        Customer::create([
            'global_id' => 'cust_003',
            'nama' => 'UD. Berkah Usaha',
            'telepon' => '022-5555555',
            'status' => 'aktif',
        ]);

        Customer::create([
            'global_id' => 'cust_004',
            'nama' => 'Toko Elektronik Emas',
            'telepon' => '061-8888888',
            'status' => 'aktif',
        ]);

        Customer::create([
            'global_id' => 'cust_005',
            'nama' => 'Klinik Kesehatan Sentosa',
            'telepon' => '0274-444444',
            'status' => 'aktif',
        ]);
    }
}
