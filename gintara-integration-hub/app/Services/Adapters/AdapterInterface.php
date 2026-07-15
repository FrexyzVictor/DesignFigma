<?php

namespace App\Services\Adapters;

interface AdapterInterface
{
    public function create(string $entityType, array $payload): array;
    public function update(string $entityType, string $targetRecordId, array $payload): array;
    public function softDelete(string $entityType, string $targetRecordId): array;
}