<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $groups = [
            'Hari Ini' => [
                [
                    'title' => 'Aplikasi disetujui',
                    'description' => 'Pengajuan kamu untuk ERP Enterprise telah berhasil disetujui.',
                    'time' => '2 jam yang lalu',
                    'icon' => 'sync',
                    'tone' => 'success',
                    'read' => false,
                ],
                [
                    'title' => 'Event baru di dekat kamu',
                    'description' => 'Sebuah event User Sync terdeteksi di modul Finance Engine.',
                    'time' => '35 menit yang lalu',
                    'icon' => 'bolt',
                    'tone' => 'primary',
                    'read' => false,
                ],
            ],

            'Kemarin' => [
                [
                    'title' => 'Jadwal pemeliharaan',
                    'description' => 'PulseBoard akan menjalani pemeliharaan pada hari Minggu antara pukul 02.00 - 04.00 UTC.',
                    'time' => 'Kemarin, 10:15',
                    'icon' => 'alert',
                    'tone' => 'warning',
                    'read' => true,
                ],
                [
                    'title' => 'Peringatan error kritis',
                    'description' => 'Kegagalan integrasi terdeteksi pada titik akses WiFiKula.',
                    'time' => 'Kemarin, 08:30',
                    'icon' => 'alert-circle',
                    'tone' => 'danger',
                    'read' => true,
                ],
            ],
        ];

        return view('dashboard.notifications.notifications', ['groups' => $groups]);
        return view('dashboard.notifications', [
            'groups' => $groups
        ]);
    }
}