<?php

namespace App\Services\Adapters;

use Illuminate\Support\Facades\Http;

class ManagementAdapter implements AdapterInterface
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('gintara.apps.management.base_url');
        $this->apiKey  = config('gintara.apps.management.api_key');
    }

    protected function endpointFor(string $entityType, string $action): string
    {
        return match ([$entityType, $action]) {
            default => match ($entityType) {
                'customer'     => match ($action) {
                    'create'      => '/api/integration/customers/create',
                    'update'      => '/api/integration/customers/update',
                    'soft_delete' => '/api/integration/customers/softdelete',
                },
                'invoice'      => '/api/integration/invoices/update',
                'payment'      => '/api/integration/payments/update',
                'pppoe'        => '/api/integration/pppoe/update',
                default        => '/api/integration/customers/create',
            },
        };
    }

    protected function send(string $entityType, string $action, array $payload): array
    {
        $endpoint = $this->endpointFor($entityType, $action);

        $response = Http::withHeaders([
            'X-Gintara-Client'  => 'integration-hub',
            'X-Gintara-Api-Key' => $this->apiKey,
        ])->post("{$this->baseUrl}{$endpoint}", $payload);

        return [
            'success' => $response->successful(),
            'status'  => $response->status(),
            'body'    => $response->json(),
        ];
    }

    public function create(string $entityType, array $payload): array
    {
        return $this->send($entityType, 'create', $payload);
    }

    public function update(string $entityType, string $targetRecordId, array $payload): array
    {
        return $this->send($entityType, 'update', $payload + ['record_id' => $targetRecordId]);
    }

    public function softDelete(string $entityType, string $targetRecordId): array
    {
        return $this->send($entityType, 'soft_delete', ['record_id' => $targetRecordId]);
    }
}