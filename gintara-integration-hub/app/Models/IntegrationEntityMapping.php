<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegrationEntityMapping extends Model
{
    protected $fillable = [
        'entity_type', 'global_id', 'app_name', 'app_record_id', 'app_record_key', 'status',
    ];
}
