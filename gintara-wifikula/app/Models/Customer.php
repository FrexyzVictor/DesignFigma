<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'global_id', 'nama', 'telepon', 'paket', 'harga_paket',
        'status_pelanggan', 'status_langganan', 'network_status',
        'billing_status', 'outstanding_amount', 'is_disabled',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
