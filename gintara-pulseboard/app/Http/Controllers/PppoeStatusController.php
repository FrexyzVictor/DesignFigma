<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\HubEventEmitter;
use Illuminate\Http\Request;

class PppoeStatusController extends Controller
{
    public function __construct(protected HubEventEmitter $emitter)
    {
    }

    public function updateStatus(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'network_status' => 'required|in:online,offline',
        ]);

        $customer->pppoeMonitoring?->update([
            'network_status' => $validated['network_status'],
            'last_online_at'  => $validated['network_status'] === 'online' ? now() : null,
        ]);

        $eventType = $validated['network_status'] === 'online' ? 'pppoe.online' : 'pppoe.offline';

        $result = $this->emitter->emit(
            $eventType,
            'pppoe',
            (string) $customer->id,
            [
                'global_customer_id' => $customer->global_id,
                'network_status'     => $validated['network_status'],
            ]
        );

        return response()->json([
            'message'  => 'Status PPPoE diperbarui.',
            'customer' => $customer->load('pppoeMonitoring'),
            'sync'     => $result['success'] ? 'sent to hub' : 'failed, will retry later',
        ]);
    }
}