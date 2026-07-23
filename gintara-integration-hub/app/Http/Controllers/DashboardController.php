<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ganti dengan query asli kamu (mis. dari model Kegiatan, Sinkronisasi, dll)
        $data = [
            'greeting' => $this->greetingByTime(),
            'user' => $request->user() ?? (object) ['name' => 'Diyo', 'avatar' => null],
            'stats' => [
                ['label' => 'Total Kegiatan', 'value' => 15, 'trend' => '+12%', 'trendUp' => true, 'icon' => 'bolt'],
                ['label' => 'Pekerjaan Tertunda', 'value' => 5, 'icon' => 'clock'],
                ['label' => 'Sinkronisasi Berhasil', 'value' => '64.5%', 'icon' => 'check', 'tone' => 'success'],
                ['label' => 'Sinkronisasi Gagal', 'value' => '35.5%', 'icon' => 'alert', 'tone' => 'danger'],
            ],
            'quickActions' => [
                ['label' => 'Buat Kegiatan', 'icon' => 'plus', 'route' => '#'],
                ['label' => 'Sinkronkan Data', 'icon' => 'refresh', 'route' => '#'],
                ['label' => 'Kelola Aplikasi', 'icon' => 'layers', 'route' => '#'],
                ['label' => 'Lihat Log', 'icon' => 'list', 'route' => '#'],
            ],
            'apps' => [
                ['name' => 'Management', 'desc' => 'ERP Enterprise', 'status' => 'online'],
                ['name' => 'Billing', 'desc' => 'Finance Engine', 'status' => 'online'],
                ['name' => 'PulseBoard', 'desc' => 'Analytics View', 'status' => 'maintenance'],
                ['name' => 'WiFiKula', 'desc' => 'Guest WiFi', 'status' => 'offline'],
            ],
            'activities' => [
                ['title' => 'Sinkronisasi Pengguna', 'ref' => 'EVT-991', 'source' => 'Penagihan', 'time' => '3 menit yang lalu', 'status' => 'berhasil'],
                ['title' => 'Arsip Log', 'ref' => 'EVT-990', 'source' => 'WifiKula', 'time' => '15 menit yang lalu', 'status' => 'tertunda'],
                ['title' => 'API Gateway', 'ref' => 'EVT-880', 'source' => 'Manajemen', 'time' => '1 jam yang lalu', 'status' => 'gagal'],
            ],
        ];

        return view('dashboard.dashboard', $data);
    }

    protected function greetingByTime(): string
    {
        $hour = now()->hour;

        return match (true) {
            $hour < 11 => 'Selamat Pagi',
            $hour < 15 => 'Selamat Siang',
            $hour < 18 => 'Selamat Sore',
            default => 'Selamat Malam',
        };
    }
}
