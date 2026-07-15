<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegrationSyncJob extends Model
{
    protected $fillable = [
        'event_id', 'source_app', 'target_app', 'action', 'entity_type', 'global_id',
        'payload', 'status', 'retry_count', 'max_retry', 'error_message', 'processed_at',
    ];
    public $timestamps = false;
}
