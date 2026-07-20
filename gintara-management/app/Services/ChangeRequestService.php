<?php

namespace App\Services;

use App\Models\ChangeRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChangeRequestService
{
    /**
     * Create a change request for approval workflow
     * If user is super_admin, apply directly. If admin, create pending request.
     */
    public function createChangeRequest(
        string $entityType,
        int $entityId,
        string $action,
        array $newData,
        ?array $oldData = null
    ): array {
        $user = Auth::user();

        // Super Admin: apply directly
        if ($user->isSuperAdmin()) {
            return [
                'success' => true,
                'applied' => true,
                'message' => 'Change applied directly (Super Admin)',
                'data' => null,
            ];
        }

        // Admin: create pending change request
        $changeRequest = ChangeRequest::create([
            'user_id'     => $user->id,
            'entity_type' => $entityType,
            'entity_id'   => $entityId,
            'action'      => $action,
            'old_data'    => $oldData,
            'new_data'    => $newData,
            'status'      => 'pending',
        ]);

        return [
            'success' => true,
            'applied' => false,
            'message' => 'Change request created, awaiting approval',
            'data'    => $changeRequest,
        ];
    }

    /**
     * Approve a change request
     */
    public function approveChangeRequest(ChangeRequest $request, ?string $reason = null): array
    {
        $user = Auth::user();

        if (!$user->isSuperAdmin()) {
            return [
                'success' => false,
                'message' => 'Only Super Admin can approve change requests',
            ];
        }

        if (!$request->isPending()) {
            return [
                'success' => false,
                'message' => "Change request is already {$request->status}",
            ];
        }

        $request->update([
            'status'      => 'approved',
            'approved_by' => $user->id,
            'approved_at' => now(),
        ]);

        return [
            'success' => true,
            'message' => 'Change request approved',
            'data'    => $request,
        ];
    }

    /**
     * Reject a change request
     */
    public function rejectChangeRequest(ChangeRequest $request, string $reason): array
    {
        $user = Auth::user();

        if (!$user->isSuperAdmin()) {
            return [
                'success' => false,
                'message' => 'Only Super Admin can reject change requests',
            ];
        }

        if (!$request->isPending()) {
            return [
                'success' => false,
                'message' => "Change request is already {$request->status}",
            ];
        }

        $request->update([
            'status'             => 'rejected',
            'approved_by'        => $user->id,
            'rejection_reason'   => $reason,
            'approved_at'        => now(),
        ]);

        return [
            'success' => true,
            'message' => 'Change request rejected',
            'data'    => $request,
        ];
    }

    /**
     * Get pending change requests
     */
    public function getPendingRequests()
    {
        return ChangeRequest::where('status', 'pending')
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
