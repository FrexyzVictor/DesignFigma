<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Ticket;
use App\Services\HubEventEmitter;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(protected HubEventEmitter $emitter)
    {
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'global_customer_id' => 'required|string',
            'judul'               => 'required|string|max:200',
            'deskripsi'           => 'nullable|string',
        ]);

        $customer = Customer::where('global_id', $validated['global_customer_id'])->first();

        if (!$customer) {
            return response()->json(['message' => 'Customer tidak ditemukan.'], 404);
        }

        $ticket = Ticket::create([
            'customer_id' => $customer->id,
            'judul'       => $validated['judul'],
            'deskripsi'   => $validated['deskripsi'] ?? null,
            'status'      => 'open',
        ]);

        $result = $this->emitter->emit(
            'ticket.created',
            'ticket',
            (string) $ticket->id,
            [
                'global_customer_id' => $customer->global_id,
                'judul'              => $ticket->judul,
                'deskripsi'          => $ticket->deskripsi,
                'status'             => $ticket->status,
            ]
        );

        return response()->json([
            'message' => 'Laporan gangguan berhasil dikirim.',
            'ticket'  => $ticket,
            'sync'    => $result['success'] ? 'sent to hub' : 'failed, will retry later',
        ], 201);
    }
}