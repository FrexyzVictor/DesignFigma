<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegrationLog extends Model
{
    protected $fillable = [
        'source_app', 'target_app', 'endpoint', 'method', 'request_payload',
        'response_payload', 'http_status', 'status', 'error_message',
    ];
    public $timestamps = false;
}
