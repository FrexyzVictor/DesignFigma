<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerSnapshot extends Model
{
    protected $fillable = [
        'global_customer_id', 'nama', 'telepon', 'alamat', 'status_pelanggan',
        'status_langganan', 'paket', 'harga_paket', 'pppoe_username', 'router',
        'network_status', 'billing_status', 'outstanding_amount', 'last_payment_at', 'last_online_at',
    ];
    const CREATED_AT = null;
}
