<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'nama',
        'tanggal',
        'lokasi',
        'penyelenggara',
        'status',
        'deskripsi',
    ];
}