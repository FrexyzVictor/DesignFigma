<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IntegrationEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id'          => 'required|string|max:100',
            'event_type'        => 'required|string|max:100',
            'source_app'        => 'required|string|max:50',
            'entity_type'       => 'required|string|max:50',
            'source_record_id'  => 'nullable|string|max:100',
            'timestamp'         => 'nullable|string',
            'data'              => 'required|array',
        ]);

        // Cek idempotency: kalau event_id sudah pernah masuk, jangan diproses ulang
        $existing = IntegrationEvent::where('event_id', $validated['event_id'])->first();

        if ($existing) {
            return response()->json([
                'message' => 'Event already received (duplicate ignored).',
                'event_id' => $existing->event_id,
                'status' => $existing->status,
            ], 200);
        }

        $event = IntegrationEvent::create([
            'event_id'         => $validated['event_id'],
            'event_type'       => $validated['event_type'],
            'source_app'       => $validated['source_app'],
            'entity_type'      => $validated['entity_type'],
            'source_record_id' => $validated['source_record_id'] ?? null,
            'payload'          => json_encode($validated['data']),
            'status'           => 'pending',
        ]);

        return response()->json([
            'message'  => 'Event received and queued for processing.',
            'event_id' => $event->event_id,
            'status'   => $event->status,
        ], 201);
    }
}