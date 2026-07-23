<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();

        return view('event.index', compact('events'));
    }

    public function create()
    {
        return view('event.create');
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
            ->route('event.index')
            ->with('success', 'Event berhasil ditambahkan.');
    }

    public function show(Event $event)
    {
        return view('event.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
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
            ->route('event.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('event.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}