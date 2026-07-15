<?php

namespace App\Services\Adapters;

use Illuminate\Support\Facades\Http;

class BillingAdapter implements AdapterInterface
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('gintara.apps.billing.base_url');
        $this->apiKey  = config('gintara.apps.billing.api_key');
    }

    public function create(string $entityType, array $payload): array
    {
        $response = Http::withHeaders([
            'X-Gintara-Client'  => 'integration-hub',
            'X-Gintara-Api-Key' => $this->apiKey,
        ])->post("{$this->baseUrl}/api/integration/customers/create", $payload);

        return ['success' => $response->successful(), 'status' => $response->status(), 'body' => $response->json()];
    }

    public function update(string $entityType, string $targetRecordId, array $payload): array
    {
        $response = Http::withHeaders([
            'X-Gintara-Client'  => 'integration-hub',
            'X-Gintara-Api-Key' => $this->apiKey,
        ])->post("{$this->baseUrl}/api/integration/subscriptions/update", $payload + ['record_id' => $targetRecordId]);

        return ['success' => $response->successful(), 'status' => $response->status(), 'body' => $response->json()];
    }

    public function softDelete(string $entityType, string $targetRecordId): array
    {
        $response = Http::withHeaders([
            'X-Gintara-Client'  => 'integration-hub',
            'X-Gintara-Api-Key' => $this->apiKey,
        ])->post("{$this->baseUrl}/api/integration/customers/softdelete", ['record_id' => $targetRecordId]);

        return ['success' => $response->successful(), 'status' => $response->status(), 'body' => $response->json()];
    }
}