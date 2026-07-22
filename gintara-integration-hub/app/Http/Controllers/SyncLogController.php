<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SyncLogController extends Controller
{
    public function index(Request $request)
    {
        // Ganti dengan query asli, mis. SyncLog::query()->latest()->paginate(...)
        $logs = [
            ['app' => 'Sistem Manajemen', 'ref' => 'SYNC-1042', 'direction' => 'Tarik (Pull)', 'records' => 1284, 'duration' => '12 dtk', 'time' => '2 menit yang lalu', 'status' => 'berhasil', 'icon' => 'erp'],
            ['app' => 'Penagihan',        'ref' => 'SYNC-1041', 'direction' => 'Dorong (Push)', 'records' => 356,  'duration' => '5 dtk',  'time' => '14 menit yang lalu', 'status' => 'berhasil', 'icon' => 'billing'],
            ['app' => 'PulseBoard',       'ref' => 'SYNC-1039', 'direction' => 'Tarik (Pull)', 'records' => 92,   'duration' => '—',      'time' => '2 jam yang lalu', 'status' => 'tertunda', 'icon' => 'pulse'],
            ['app' => 'WiFiKula',         'ref' => 'SYNC-1035', 'direction' => 'Dorong (Push)', 'records' => 0,    'duration' => '3 dtk',  'time' => '1 jam yang lalu', 'status' => 'gagal', 'icon' => 'wifi'],
        ];

        $summary = [
            'total' => count($logs),
            'success' => collect($logs)->where('status', 'berhasil')->count(),
            'failed' => collect($logs)->where('status', 'gagal')->count(),
        ];

        return view('sync-logs', ['logs' => $logs, 'summary' => $summary]);
    }
}
    