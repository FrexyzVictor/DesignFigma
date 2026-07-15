<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use App\Services\HubEventEmitter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function __construct(protected HubEventEmitter $emitter)
    {
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'global_customer_id' => 'required|string', // global_id pelanggan
            'jumlah'              => 'required|numeric',
            'jatuh_tempo'         => 'required|date',
        ]);

        $customer = Customer::where('global_id', $validated['global_customer_id'])->first();

        if (!$customer) {
            return response()->json(['message' => 'Customer dengan global_id ini tidak ditemukan di Billing.'], 404);
        }

        $invoice = Invoice::create([
            'customer_id'  => $customer->id,
            'no_invoice'   => 'INV-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6)),
            'jumlah'       => $validated['jumlah'],
            'jatuh_tempo'  => $validated['jatuh_tempo'],
            'status'       => 'unpaid',
        ]);

        $result = $this->emitter->emit(
            'invoice.created',
            'invoice',
            (string) $invoice->id,
            [
                'global_customer_id' => $customer->global_id,
                'no_invoice'         => $invoice->no_invoice,
                'jumlah'             => $invoice->jumlah,
                'jatuh_tempo'        => $invoice->jatuh_tempo,
                'status'             => $invoice->status,
            ]
        );

        return response()->json([
            'message' => 'Invoice berhasil dibuat.',
            'invoice' => $invoice,
            'sync'    => $result['success'] ? 'sent to hub' : 'failed, will retry later',
        ], 201);
    }

    public function pay(Invoice $invoice)
    {
        $invoice->update(['status' => 'paid']);

        $payment = $invoice->payments()->create([
            'jumlah'  => $invoice->jumlah,
            'paid_at' => now(),
            'status'  => 'paid',
        ]);

        $result = $this->emitter->emit(
            'payment.paid',
            'payment',
            (string) $payment->id,
            [
                'global_customer_id' => $invoice->customer->global_id,
                'no_invoice'         => $invoice->no_invoice,
                'jumlah'             => $payment->jumlah,
                'paid_at'            => $payment->paid_at,
            ]
        );

        return response()->json([
            'message' => 'Pembayaran berhasil dicatat.',
            'invoice' => $invoice,
            'sync'    => $result['success'] ? 'sent to hub' : 'failed, will retry later',
        ]);
    }
}