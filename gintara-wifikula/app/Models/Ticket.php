<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['global_id', 'customer_id', 'judul', 'deskripsi', 'status'];

        public function customer()
        {
            return $this->belongsTo(Customer::class);
        }
}
