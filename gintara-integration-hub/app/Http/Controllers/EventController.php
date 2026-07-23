<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = [
            [
                'title' => 'Unggah Arsip Log',
                'ref' => 'EVT-991',
                'source' => 'WifiKula',
                'time' => '12 menit lalu',
                'status' => 'tertunda',
                'icon' => 'upload'
            ],
            [
                'title' => 'Kegagalan API Gateway',
                'ref' => 'EVT-990',
                'source' => 'ERP Perusahaan',
                'time' => '45 menit lalu',
                'status' => 'gagal',
                'icon' => 'alert'
            ],
            [
                'title' => 'Sinkronisasi Audit Keamanan',
                'ref' => 'EVT-988',
                'source' => 'Layanan Autentikasi',
                'time' => '2 jam lalu',
                'status' => 'berhasil',
                'icon' => 'shield'
            ],
            [
                'title' => 'Pembersihan Database',
                'ref' => 'EVT-985',
                'source' => 'Admin Inti',
                'time' => '5 jam lalu',
                'status' => 'berhasil',
                'icon' => 'database'
            ],
        ];

        return view('dashboard.events.events', [
            'events' => $events,
            'dateRange' => 'Jul 09, 2026 - Jul 10, 2026',
        ]);
    }
}