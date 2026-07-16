<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Customer;
use App\Services\HubEventEmitter;
use App\Services\ChangeRequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct(
        protected HubEventEmitter $emitter,
        protected ChangeRequestService $changeRequestService
    ) {
    }

    /**
     * Display a listing of subscriptions
     */
    public function index(Request $request)
    {
        $query = Subscription::with('customer');

        if ($request->has('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        return response()->json([
            'message' => 'Subscriptions list',
            'data'    => $query->get(),
        ]);
    }

    /**
     * Store a newly created subscription
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'paket'       => 'required|string|max:100',
            'harga'       => 'required|numeric|min:0',
            'status'      => 'sometimes|in:active,suspended,terminated',
            'tanggal_mulai' => 'nullable|date',
        ]);

        $customer = Customer::findOrFail($validated['customer_id']);

        // Super Admin: direct
        if ($user->isSuperAdmin()) {
            $sub = Subscription::create($validated + ['status' => 'active']);

            $this->emitter->emit('subscription.created', 'subscription', (string) $sub->id, [
                'global_customer_id' => $customer->global_id ?? $customer->id,
                'paket'  => $sub->paket,
                'harga'  => $sub->harga,
                'status' => $sub->status,
            ]);

            return response()->json([
                'message'      => 'Subscription berhasil dibuat.',
                'subscription' => $sub,
            ], 201);
        }

        // Admin: approval
        $changeRequest = $this->changeRequestService->createChangeRequest(
            'subscription', 0, 'create', $validated
        );

        return response()->json([
            'message'         => 'Subscription creation request sent for approval',
            'change_request'  => $changeRequest['data'],
            'requires_approval' => true,
        ], 201);
    }

    /**
     * Display the specified subscription
     */
    public function show(Subscription $subscription)
    {
        return response()->json([
            'message' => 'Subscription detail',
            'data'    => $subscription->load('customer'),
        ]);
    }

    /**
     * Update the specified subscription
     */
    public function update(Request $request, Subscription $subscription)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'paket'       => 'sometimes|string|max:100',
            'harga'       => 'sometimes|numeric|min:0',
            'status'      => 'sometimes|in:active,suspended,terminated',
            'tanggal_mulai' => 'nullable|date',
        ]);

        // Super Admin: direct
        if ($user->isSuperAdmin()) {
            $oldData = $subscription->only(array_keys($validated));
            $subscription->update($validated);

            $this->emitter->emit('subscription.updated', 'subscription', (string) $subscription->id, [
                'paket'  => $subscription->paket,
                'harga'  => $subscription->harga,
                'status' => $subscription->status,
            ]);

            return response()->json([
                'message'      => 'Subscription berhasil diupdate.',
                'subscription' => $subscription,
            ]);
        }

        // Admin: approval
        $oldData = $subscription->only(array_keys($validated));
        $changeRequest = $this->changeRequestService->createChangeRequest(
            'subscription', $subscription->id, 'update', $validated, $oldData
        );

        return response()->json([
            'message'         => 'Update request sent for approval',
            'change_request'  => $changeRequest['data'],
            'requires_approval' => true,
        ]);
    }

    /**
     * Remove the specified subscription
     */
    public function destroy(Subscription $subscription)
    {
        $user = Auth::user();

        // Super Admin: direct
        if ($user->isSuperAdmin()) {
            $subscription->update(['status' => 'terminated']);
            $subscription->delete();

            $this->emitter->emit('subscription.deleted', 'subscription', (string) $subscription->id, [
                'status' => 'terminated'
            ]);

            return response()->json([
                'message' => 'Subscription berhasil dihapus (soft delete).',
            ]);
        }

        // Admin: approval
        $changeRequest = $this->changeRequestService->createChangeRequest(
            'subscription', $subscription->id, 'delete', ['status' => 'terminated'],
            ['status' => $subscription->status]
        );

        return response()->json([
            'message'         => 'Delete request sent for approval',
            'change_request'  => $changeRequest['data'],
            'requires_approval' => true,
        ]);
    }
}
