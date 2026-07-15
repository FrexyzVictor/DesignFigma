<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['global_id', 'invoice_id', 'jumlah', 'paid_at', 'status'];

public function invoice()
{
    return $this->belongsTo(Invoice::class);
}
}
