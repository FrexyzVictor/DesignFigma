<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Customer;
use App\Services\HubEventEmitter;
use App\Services\ChangeRequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct(
        protected HubEventEmitter $emitter,
        protected ChangeRequestService $changeRequestService
    ) {
    }

    /**
     * Get all tickets
     */
    public function index(Request $request)
    {
        $query = Ticket::with('customer');

        if ($request->has('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        return response()->json([
            'message' => 'Tickets list',
            'data'    => $query->orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Create new ticket
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'status'      => 'sometimes|in:open,in_progress,resolved,closed',
        ]);

        $customer = Customer::findOrFail($validated['customer_id']);

        // Super Admin: direct
        if ($user->isSuperAdmin()) {
            $ticket = Ticket::create($validated + ['status' => 'open', 'source_app' => 'management']);

            $this->emitter->emit('ticket.created', 'ticket', (string) $ticket->id, [
                'global_customer_id' => $customer->global_id ?? $customer->id,
                'judul'    => $ticket->judul,
                'deskripsi' => $ticket->deskripsi,
                'status'   => $ticket->status,
            ]);

            return response()->json([
                'message' => 'Ticket berhasil dibuat.',
                'ticket'  => $ticket,
            ], 201);
        }

        // Admin: approval
        $changeRequest = $this->changeRequestService->createChangeRequest(
            'ticket', 0, 'create', $validated
        );

        return response()->json([
            'message'         => 'Ticket creation request sent for approval',
            'change_request'  => $changeRequest['data'],
            'requires_approval' => true,
        ], 201);
    }

    /**
     * Get ticket detail
     */
    public function show(Ticket $ticket)
    {
        return response()->json([
            'message' => 'Ticket detail',
            'data'    => $ticket->load('customer'),
        ]);
    }

    /**
     * Update ticket
     */
    public function update(Request $request, Ticket $ticket)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'judul'     => 'sometimes|string|max:255',
            'deskripsi' => 'sometimes|string',
            'status'    => 'sometimes|in:open,in_progress,resolved,closed',
        ]);

        // Super Admin: direct
        if ($user->isSuperAdmin()) {
            $oldData = $ticket->only(array_keys($validated));
            $ticket->update($validated);

            $this->emitter->emit('ticket.updated', 'ticket', (string) $ticket->id, [
                'judul'  => $ticket->judul,
                'status' => $ticket->status,
            ]);

            return response()->json([
                'message' => 'Ticket berhasil diupdate.',
                'ticket'  => $ticket,
            ]);
        }

        // Admin: approval
        $oldData = $ticket->only(array_keys($validated));
        $changeRequest = $this->changeRequestService->createChangeRequest(
            'ticket', $ticket->id, 'update', $validated, $oldData
        );

        return response()->json([
            'message'         => 'Update request sent for approval',
            'change_request'  => $changeRequest['data'],
            'requires_approval' => true,
        ]);
    }

    /**
     * Close/Delete ticket
     */
    public function destroy(Ticket $ticket)
    {
        $user = Auth::user();

        // Super Admin: direct
        if ($user->isSuperAdmin()) {
            $ticket->update(['status' => 'closed']);
            $ticket->delete();

            $this->emitter->emit('ticket.closed', 'ticket', (string) $ticket->id, [
                'status' => 'closed'
            ]);

            return response()->json([
                'message' => 'Ticket berhasil ditutup (soft delete).',
            ]);
        }

        // Admin: approval
        $changeRequest = $this->changeRequestService->createChangeRequest(
            'ticket', $ticket->id, 'delete', ['status' => 'closed'],
            ['status' => $ticket->status]
        );

        return response()->json([
            'message'         => 'Close request sent for approval',
            'change_request'  => $changeRequest['data'],
            'requires_approval' => true,
        ]);
    }
}
