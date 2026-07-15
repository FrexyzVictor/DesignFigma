<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;

    protected $fillable = ['global_id', 'customer_id', 'paket', 'harga', 'status', 'tanggal_mulai'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}