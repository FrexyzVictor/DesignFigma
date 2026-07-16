<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class IntegrationReceiverController extends Controller
{
    // Dipanggil Integration Hub kalau ada perubahan dari Billing/PulseBoard yang perlu di-reflect ke Management
    public function updateCustomer(Request $request)
    {
        $data = $request->all();
        $globalId = $data['global_id'] ?? null;

        if (!$globalId) {
            return response()->json(['message' => 'global_id wajib ada.'], 422);
        }

        $customer = Customer::where('global_id', $globalId)->first();

        if (!$customer) {
            return response()->json(['message' => 'Customer dengan global_id ini tidak ditemukan.'], 404);
        }

        $customer->update(array_intersect_key($data, array_flip(['nama', 'telepon', 'alamat', 'status'])));

        return response()->json(['message' => 'Customer berhasil diupdate dari sync.', 'customer' => $customer]);
    }

    public function softDeleteCustomer(Request $request)
    {
        $globalId = $request->input('global_id');
        $customer = Customer::where('global_id', $globalId)->first();

        if (!$customer) {
            return response()->json(['message' => 'Customer tidak ditemukan.'], 404);
        }

        $customer->update(['status' => 'deleted']);
        $customer->delete();

        return response()->json(['message' => 'Customer berhasil di-soft-delete dari sync.']);
    }

    public function updateInvoiceInfo(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Invoice info diterima di Management: ', $request->all());

        return response()->json(['message' => 'Invoice info diterima di Management.'], 200);
    }

    public function updatePaymentInfo(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Payment info diterima di Management: ', $request->all());

        return response()->json(['message' => 'Payment info diterima di Management.'], 200);
    }
}