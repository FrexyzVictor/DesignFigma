<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();

        return view('dashboard.events.index', compact('events'));
    }

    public function create()
    {
        return view('dashboard.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'required|max:255',
            'penyelenggara' => 'required|max:255',
            'status' => 'required|in:Aktif,Selesai,Dibatalkan',
            'deskripsi' => 'nullable',
        ]);

        Event::create($request->all());

        return redirect()
            ->route('dashboard.events.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    public function show(Event $event)
    {
        return view('dashboard.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('dashboard.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'required|max:255',
            'penyelenggara' => 'required|max:255',
            'status' => 'required|in:Aktif,Selesai,Dibatalkan',
            'deskripsi' => 'nullable',
        ]);

        $event->update($request->all());

        return redirect()
            ->route('dashboard.events.show', $event)
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('dashboard.events.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}