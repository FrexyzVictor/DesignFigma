<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::latest()->get()->map(function ($event) {

            return [
                'id' => $event->id,
                'title' => $event->nama,
                'ref' => 'EVT-' . str_pad($event->id, 3, '0', STR_PAD_LEFT),
                'source' => $event->penyelenggara,
                'time' => Carbon::parse($event->created_at)->diffForHumans(),
                'status' => match ($event->status) {
                    'Aktif' => 'berhasil',
                    'Selesai' => 'tertunda',
                    'Dibatalkan' => 'gagal',
                    default => 'tertunda',
                },
                'icon' => match ($event->status) {
                    'Aktif' => 'calendar',
                    'Selesai' => 'check-circle',
                    'Dibatalkan' => 'alert',
                    default => 'calendar',
                },
            ];

        });

        return view('dashboard.events', [
            'events' => $events,
            'dateRange' => now()->subDays(30)->format('d M Y') .
                ' - ' .
                now()->format('d M Y'),
        ]);
    }
}