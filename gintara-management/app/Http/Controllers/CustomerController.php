<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\HubEventEmitter;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(protected HubEventEmitter $emitter)
    {
    }

    public function store(Request $request)
    {

    
        $validated = $request->validate([
            'nama'           => 'required|string|max:150',
            'telepon'        => 'required|string|max:50',
            'alamat'         => 'nullable|string',
            'pppoe_username' => 'nullable|string|max:100',
        ]);

        $customer = Customer::create($validated + ['status' => 'aktif']);

        // Kirim event ke Integration Hub
        $result = $this->emitter->emit(
            
            'customer.created',
            'customer',
            (string) $customer->id,
            [
                'nama'           => $customer->nama,
                'telepon'        => $customer->telepon,
                'alamat'         => $customer->alamat,
                'pppoe_username' => $customer->pppoe_username,
                'status'         => $customer->status,
            ]
        );

        if ($result['success'] && isset($result['body']['event_id'])) {
        }

        $customer->update([
            'sync_status'    => $result['success'] ? 'synced' : 'pending',
            'last_synced_at' => now(),
        ]);

        return response()->json([
            'message'  => 'Customer berhasil dibuat.',
            'customer' => $customer,
            'sync'     => $result['success'] ? 'sent to hub' : 'failed, will retry later',
        ], 201);
    }

    public function index()
    {
        return response()->json(Customer::with('subscriptions', 'tickets')->get());
    }

    public function update(Request $request, Customer $customer)
{
    $validated = $request->validate([
        'nama'           => 'sometimes|string|max:150',
        'telepon'        => 'sometimes|string|max:50',
        'alamat'         => 'nullable|string',
        'pppoe_username' => 'nullable|string|max:100',
    ]);

    $customer->update($validated);

    $result = $this->emitter->emit(
        'customer.updated',
        'customer',
        (string) $customer->id,
        [
            'nama'           => $customer->nama,
            'telepon'        => $customer->telepon,
            'alamat'         => $customer->alamat,
            'pppoe_username' => $customer->pppoe_username,
            'status'         => $customer->status,
        ]
    );

    $customer->update([
        'sync_status'    => $result['success'] ? 'synced' : 'pending',
        'last_synced_at' => now(),
    ]);

    return response()->json([
        'message'  => 'Customer berhasil diupdate.',
        'customer' => $customer,
        'sync'     => $result['success'] ? 'sent to hub' : 'failed, will retry later',
    ]);
}

public function destroy(Customer $customer)
{
    // Soft delete sesuai dokumen bagian 5.3 — bukan hapus permanen
    $customer->update(['status' => 'deleted']);
    $customer->delete(); // ini soft delete karena pakai trait SoftDeletes

    $result = $this->emitter->emit(
        'customer.deleted',
        'customer',
        (string) $customer->id,
        ['status' => 'deleted']
    );

    return response()->json([
        'message' => 'Customer berhasil dinonaktifkan (soft delete).',
        'sync'    => $result['success'] ? 'sent to hub' : 'failed, will retry later',
    ]);
}
}

