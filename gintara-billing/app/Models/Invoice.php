<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['global_id', 'customer_id', 'no_invoice', 'jumlah', 'jatuh_tempo', 'status'];

public function customer()
{
    return $this->belongsTo(Customer::class);
}

public function payments()
{
    return $this->hasMany(Payment::class);
}
}
