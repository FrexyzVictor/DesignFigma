<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index(Request $request)
    {
        $apps = [
            [
                'name' => 'Sistem Manajemen',
                'category' => 'ERP Enterprise Core',
                'icon' => 'erp',
                'status' => 'aktif',
                'description' => 'Pusat perencanaan sumber daya, pelacakan inventaris, dan manajemen alur kerja organisasi.',
                'syncedAt' => '2 menit yang lalu',
                'detailRoute' => '#',
            ],
            [
                'name' => 'Penagihan',
                'category' => 'Finance Engine',
                'icon' => 'billing',
                'status' => 'aktif',
                'description' => 'Faktur otomatis, pemrosesan pembayaran, dan rekonsiliasi pendapatan untuk semua lini bisnis.',
                'syncedAt' => '14 menit yang lalu',
                'detailRoute' => '#',
            ],
            [
                'name' => 'PulseBoard',
                'category' => 'Analytics View',
                'icon' => 'pulse',
                'status' => 'pemeliharaan',
                'description' => 'Analisis kinerja kerja nyata dan dasbor untuk sistem pendukung keputusan eksekutif.',
                'syncedAt' => '2 jam yang lalu',
                'detailRoute' => '#',
            ],
            [
                'name' => 'WiFiKula',
                'category' => 'Guest WiFi Portal',
                'icon' => 'wifi',
                'status' => 'nonaktif',
                'description' => 'Manajemen titik akses publik dan portal tawanan untuk infrastruktur jaringan tamu.',
                'syncedAt' => 'Gagal (1 jam yang lalu)',
                'detailRoute' => '#',
            ],
        ];

        return view('dashboard.apps', [
            'apps' => $apps
        ]);
    }
}