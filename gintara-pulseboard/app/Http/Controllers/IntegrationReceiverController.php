<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\PppoeMonitoring;
use Illuminate\Http\Request;

class IntegrationReceiverController extends Controller
{
    public function createPppoe(Request $request)
    {
        $data = $request->all();

        $customer = Customer::updateOrCreate(
            ['global_id' => $data['global_id']],
            [
                'nama'           => $data['nama'] ?? null,
                'pppoe_username' => $data['pppoe_username'] ?? null,
                'status'         => $data['status'] ?? 'aktif',
            ]
        );

        $monitoring = PppoeMonitoring::updateOrCreate(
            ['customer_id' => $customer->id],
            [
                'global_id'      => $data['global_id'],
                'pppoe_username' => $data['pppoe_username'] ?? null,
                'network_status' => 'offline',
            ]
        );

        return response()->json(['message' => 'PPPoE monitoring dibuat.', 'customer' => $customer, 'monitoring' => $monitoring], 201);
    }

    public function disablePppoe(Request $request)
    {
        $globalId = $request->input('global_id') ?? $request->input('record_id');
        $customer = Customer::where('global_id', $globalId)->first();

        if (!$customer) {
            return response()->json(['message' => 'Customer tidak ditemukan.'], 404);
        }

        $customer->update(['status' => 'nonaktif']);
        $customer->pppoeMonitoring?->update(['network_status' => 'offline']);

        return response()->json(['message' => 'PPPoE monitoring dinonaktifkan.']);
    }
}