<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['global_id', 'nama', 'telepon', 'status'];

public function invoices()
{
    return $this->hasMany(Invoice::class);
}
}
