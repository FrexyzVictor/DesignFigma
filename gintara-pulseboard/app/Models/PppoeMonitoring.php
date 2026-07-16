<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PppoeMonitoring extends Model
{
    protected $fillable = ['global_id', 'customer_id', 'pppoe_username', 'router', 'network_status', 'last_online_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
