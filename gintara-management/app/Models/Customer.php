<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'global_id', 'nama', 'telepon', 'alamat', 'pppoe_username',
        'status', 'sync_status', 'last_synced_at', 'sync_error',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}