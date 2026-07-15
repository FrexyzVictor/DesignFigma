<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $fillable = ['global_id', 'customer_id', 'judul', 'deskripsi', 'status', 'source_app'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}