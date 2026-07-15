<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class HealthController extends Controller
{
    public function check()
    {
        return response()->json([
            'status'  => 'ok',
            'service' => 'Gintara Integration Hub',
            'time'    => now()->toDateTimeString(),
        ]);
    }
}