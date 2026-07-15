<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegrationEvent extends Model
{
    protected $fillable = [
        'event_id', 'event_type', 'source_app', 'entity_type', 'source_record_id',
        'global_id', 'payload', 'status', 'retry_count', 'error_message', 'processed_at',
    ];

    public $timestamps = false;
}