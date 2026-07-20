<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\HubEventEmitter;
use App\Services\ChangeRequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct(
        protected HubEventEmitter $emitter,
        protected ChangeRequestService $changeRequestService
    ) {
    }

    /**
     * Create new customer
     * Super Admin: direct creation
     * Admin: creates change request for approval
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'nama'           => 'required|string|max:150',
            'telepon'        => 'required|string|max:50',
            'alamat'         => 'nullable|string',
            'pppoe_username' => 'nullable|string|max:100',
        ]);

        // Super Admin: create directly
        if ($user->isSuperAdmin()) {
            $customer = Customer::create($validated + ['status' => 'aktif']);

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

            $customer->update([
                'sync_status'    => $result['success'] ? 'synced' : 'pending',
                'last_synced_at' => now(),
            ]);

            return response()->json([
                'message'  => 'Customer berhasil dibuat.',
                'customer' => $customer,
                'sync'     => $result['success'] ? 'sent to hub' : 'pending',
            ], 201);
        }

        // Admin: create change request
        $changeRequest = $this->changeRequestService->createChangeRequest(
            'customer',
            0, // temp ID for new record
            'create',
            $validated
        );

        if (!$changeRequest['applied']) {
            return response()->json([
                'message'         => 'Customer creation request sent for approval',
                'change_request'  => $changeRequest['data'],
                'requires_approval' => true,
            ], 201);
        }

        return response()->json([
            'message' => 'Customer berhasil dibuat.',
        ], 201);
    }

    /**
     * Get all customers
     */
    public function index()
    {
        return response()->json(Customer::with('subscriptions', 'tickets')->get());
    }

    /**
     * Get single customer
     */
    public function show(Customer $customer)
    {
        return response()->json([
            'message' => 'Customer detail',
            'data'    => $customer->load('subscriptions', 'tickets'),
        ]);
    }

    /**
     * Update customer
     * Super Admin: direct update
     * Admin: creates change request for approval
     */
    public function update(Request $request, Customer $customer)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama'           => 'sometimes|string|max:150',
            'telepon'        => 'sometimes|string|max:50',
            'alamat'         => 'nullable|string',
            'pppoe_username' => 'nullable|string|max:100',
        ]);

        // Super Admin: update directly
        if ($user->isSuperAdmin()) {
            $oldData = $customer->only(array_keys($validated));
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
                'sync'     => $result['success'] ? 'sent to hub' : 'pending',
            ]);
        }

        // Admin: create change request
        $oldData = $customer->only(array_keys($validated));
        $changeRequest = $this->changeRequestService->createChangeRequest(
            'customer',
            $customer->id,
            'update',
            $validated,
            $oldData
        );

        if (!$changeRequest['applied']) {
            return response()->json([
                'message'         => 'Update request sent for approval',
                'change_request'  => $changeRequest['data'],
                'requires_approval' => true,
            ]);
        }

        return response()->json([
            'message'  => 'Customer berhasil diupdate.',
            'customer' => $customer,
        ]);
    }

    /**
     * Soft delete customer
     * Super Admin: direct delete
     * Admin: creates change request for approval
     */
    public function destroy(Request $request, Customer $customer)
    {
        $user = Auth::user();

        // Super Admin: delete directly
        if ($user->isSuperAdmin()) {
            $customer->update(['status' => 'deleted']);
            $customer->delete(); // soft delete

            $result = $this->emitter->emit(
                'customer.deleted',
                'customer',
                (string) $customer->id,
                ['status' => 'deleted']
            );

            return response()->json([
                'message' => 'Customer berhasil dinonaktifkan (soft delete).',
                'sync'    => $result['success'] ? 'sent to hub' : 'pending',
            ]);
        }

        // Admin: create change request
        $changeRequest = $this->changeRequestService->createChangeRequest(
            'customer',
            $customer->id,
            'delete',
            ['status' => 'deleted'],
            ['status' => $customer->status]
        );

        if (!$changeRequest['applied']) {
            return response()->json([
                'message'         => 'Delete request sent for approval',
                'change_request'  => $changeRequest['data'],
                'requires_approval' => true,
            ]);
        }

        return response()->json([
            'message' => 'Customer berhasil dinonaktifkan.',
        ]);
    }
}