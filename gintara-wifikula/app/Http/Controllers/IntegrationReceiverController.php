<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class IntegrationReceiverController extends Controller
{
    public function createOrUpdateCustomer(Request $request)
    {
        $data = $request->all();

        if (isset($data['status']) && $data['status'] === 'disabled') {
            $customer = Customer::where('global_id', $data['global_id'] ?? $data['record_id'] ?? null)->first();
            if ($customer) {
                $customer->update(['is_disabled' => true]);
                return response()->json(['message' => 'Akun pelanggan dinonaktifkan.']);
            }
            return response()->json(['message' => 'Customer tidak ditemukan.'], 404);
        }

        $customer = Customer::updateOrCreate(
            ['global_id' => $data['global_id']],
            [
                'nama'             => $data['nama'] ?? null,
                'telepon'          => $data['telepon'] ?? null,
                'paket'            => $data['paket'] ?? null,
                'harga_paket'      => $data['harga'] ?? 0,
                'status_pelanggan' => $data['status'] ?? 'aktif',
            ]
        );

        return response()->json(['message' => 'Customer berhasil dibuat/diupdate.', 'customer' => $customer], 201);
    }

    public function updateBillingInfo(Request $request)
    {
        $data = $request->all();
        $customer = Customer::where('global_id', $data['global_customer_id'] ?? null)->first();

        if (!$customer) {
            return response()->json(['message' => 'Customer tidak ditemukan.'], 404);
        }

        if (isset($data['no_invoice'])) {
            $customer->update([
                'billing_status'      => $data['status'] ?? 'unpaid',
                'outstanding_amount'  => $data['jumlah'] ?? $customer->outstanding_amount,
            ]);
        }

        return response()->json(['message' => 'Info billing diperbarui.', 'customer' => $customer]);
    }
}