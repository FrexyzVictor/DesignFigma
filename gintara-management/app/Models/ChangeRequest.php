<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChangeRequest extends Model
{
    protected $fillable = [
        'user_id', 'entity_type', 'entity_id', 'action',
        'old_data', 'new_data', 'status', 'approved_by', 'rejection_reason', 'approved_at'
    ];

    protected $casts = [
        'old_data' => 'json',
        'new_data' => 'json',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}

