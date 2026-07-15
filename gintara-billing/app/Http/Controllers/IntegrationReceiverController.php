<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class IntegrationReceiverController extends Controller
{
    public function createCustomer(Request $request)
    {
        $data = $request->all();

        $customer = Customer::updateOrCreate(
            ['global_id' => $data['global_id']],
            [
                'nama'    => $data['nama'] ?? null,
                'telepon' => $data['telepon'] ?? null,
                'status'  => $data['status'] ?? 'aktif',
            ]
        );

        return response()->json(['message' => 'Customer berhasil dibuat/diupdate di Billing.', 'customer' => $customer], 201);
    }

    public function softDeleteCustomer(Request $request)
    {
        $customer = Customer::where('global_id', $request->input('global_id'))->first();

        if (!$customer) {
            return response()->json(['message' => 'Customer tidak ditemukan.'], 404);
        }

        $customer->update(['status' => 'inactive']); // soft delete: invoice/payment tetap ada

        return response()->json(['message' => 'Customer berhasil dinonaktifkan di Billing (invoice & payment tetap tersimpan).']);
    }
}