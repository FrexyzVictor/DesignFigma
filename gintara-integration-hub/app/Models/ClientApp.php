<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientApp extends Model
{
    protected $fillable = ['app_name', 'api_key', 'api_secret', 'is_active'];
}
