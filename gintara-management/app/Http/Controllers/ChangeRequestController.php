<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChangeRequest;
use App\Services\ChangeRequestService;
use Illuminate\Http\Request;

class ChangeRequestController extends Controller
{
    public function __construct(protected ChangeRequestService $changeRequestService)
    {
    }

    /**
     * Display pending change requests (Super Admin only)
     */
    public function index()
    {
        $requests = $this->changeRequestService->getPendingRequests();

        return response()->json([
            'message' => 'Pending change requests',
            'data'    => $requests,
        ]);
    }

    /**
     * Store/Create not used - approval workflow
     */
    public function store(Request $request)
    {
        return response()->json(['message' => 'Use entity endpoints to create change requests'], 405);
    }

    /**
     * Get change request details
     */
    public function show(ChangeRequest $id)
    {
        return response()->json([
            'message' => 'Change request details',
            'data'    => $id->load('user', 'approver'),
        ]);
    }

    /**
     * Approve a change request (Super Admin only)
     */
    public function approve(Request $request, ChangeRequest $changeRequest)
    {
        $validated = $request->validate([
            'reason' => 'nullable|string',
        ]);

        $result = $this->changeRequestService->approveChangeRequest(
            $changeRequest,
            $validated['reason'] ?? null
        );

        if (!$result['success']) {
            return response()->json(['message' => $result['message']], 400);
        }

        return response()->json([
            'message' => $result['message'],
            'data'    => $result['data'],
        ]);
    }

    /**
     * Reject a change request (Super Admin only)
     */
    public function reject(Request $request, ChangeRequest $changeRequest)
    {
        $validated = $request->validate([
            'reason' => 'required|string',
        ]);

        $result = $this->changeRequestService->rejectChangeRequest(
            $changeRequest,
            $validated['reason']
        );

        if (!$result['success']) {
            return response()->json(['message' => $result['message']], 400);
        }

        return response()->json([
            'message' => $result['message'],
            'data'    => $result['data'],
        ]);
    }

    /**
     * Show change request history for specific entity
     */
    public function history(string $entityType, int $entityId)
    {
        $requests = ChangeRequest::where('entity_type', $entityType)
            ->where('entity_id', $entityId)
            ->with('user', 'approver')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'message' => 'Change request history',
            'entity_type' => $entityType,
            'entity_id'   => $entityId,
            'data'        => $requests,
        ]);
    }

    /**
     * Update/Destroy not used
     */
    public function update(Request $request, string $id)
    {
        return response()->json(['message' => 'Use approve/reject endpoints'], 405);
    }

    public function destroy(string $id)
    {
        return response()->json(['message' => 'Change requests cannot be deleted'], 405);
    }
}

