<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['global_id', 'nama', 'pppoe_username', 'status'];

    public function pppoeMonitoring()
    {
        return $this->hasOne(PppoeMonitoring::class);
    }
}
