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
        // Create test customers
        Customer::create([
            'nama' => 'PT. Maju Jaya',
            'telepon' => '021-1234567',
            'alamat' => 'Jl. Sudirman No. 123, Jakarta',
            'pppoe_username' => 'majujaya',
            'status' => 'aktif',
        ]);

        Customer::create([
            'nama' => 'CV. Sukses Mandiri',
            'telepon' => '031-7654321',
            'alamat' => 'Jl. Gatot Subroto No. 456, Surabaya',
            'pppoe_username' => 'suksesmandiri',
            'status' => 'aktif',
        ]);

        Customer::create([
            'nama' => 'UD. Berkah Usaha',
            'telepon' => '022-5555555',
            'alamat' => 'Jl. Ahmad Yani No. 789, Bandung',
            'pppoe_username' => 'berkahusaha',
            'status' => 'aktif',
        ]);

        Customer::create([
            'nama' => 'Toko Elektronik Emas',
            'telepon' => '061-8888888',
            'alamat' => 'Jl. Merdeka No. 321, Medan',
            'pppoe_username' => 'tokoemas',
            'status' => 'aktif',
        ]);

        Customer::create([
            'nama' => 'Klinik Kesehatan Sentosa',
            'telepon' => '0274-444444',
            'alamat' => 'Jl. Diponegoro No. 654, Yogyakarta',
            'pppoe_username' => 'klinikkesehatan',
            'status' => 'aktif',
        ]);
    }
}
