<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class HubEventEmitter
{
    protected string $hubUrl;
    protected string $clientName = 'management';
    protected string $apiKey;
    protected string $apiSecret;

    public function __construct()
    {
        $this->hubUrl   = config('services.hub.base_url');
        $this->apiKey   = config('services.hub.api_key');
        $this->apiSecret = config('services.hub.api_secret');
    }

    public function emit(string $eventType, string $entityType, string $sourceRecordId, array $data): array
    {
        $payload = json_encode([
            'event_id'         => 'EVT-' . now()->format('Ymd') . '-' . Str::random(8),
            'event_type'       => $eventType,
            'source_app'       => $this->clientName,
            'entity_type'      => $entityType,
            'source_record_id' => (string) $sourceRecordId,
            'timestamp'        => now()->toDateTimeString(),
            'data'             => $data,
        ]);

        $timestamp = now()->toIso8601String();
        $signature = hash_hmac('sha256', $payload . $timestamp, $this->apiSecret);

        try {
            $response = Http::withHeaders([
                'Content-Type'        => 'application/json',
                'X-Gintara-Client'     => $this->clientName,
                'X-Gintara-Api-Key'    => $this->apiKey,
                'X-Gintara-Timestamp'  => $timestamp,
                'X-Gintara-Signature'  => $signature,
            ])->withBody($payload, 'application/json')
              ->post("{$this->hubUrl}/api/v1/events");

            return [
                'success' => $response->successful(),
                'status'  => $response->status(),
                'body'    => $response->json(),
            ];
        } catch (\Throwable $e) {
            Log::error('Gagal kirim event ke Hub: ' . $e->getMessage());
            return ['success' => false, 'status' => 0, 'body' => null];
        }
    }
}