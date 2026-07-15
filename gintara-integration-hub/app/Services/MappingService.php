<?php

namespace App\Services;

use App\Models\IntegrationEntityMapping;
use Illuminate\Support\Str;

class MappingService
{
    /**
     * Generate global_id baru, format: HUB-{ENTITY}-{NNNNNN}
     */
    public function createGlobalId(string $entityType): string
    {
        $prefix = 'HUB-' . strtoupper($entityType);
        $count = IntegrationEntityMapping::where('entity_type', $entityType)
            ->distinct('global_id')
            ->count('global_id');

        $next = str_pad($count + 1, 6, '0', STR_PAD_LEFT);

        return "{$prefix}-{$next}";
    }

    /**
     * Cari mapping berdasarkan entity_type + app_name + app_record_id
     */
    public function findMapping(string $entityType, string $appName, string $appRecordId): ?IntegrationEntityMapping
    {
        return IntegrationEntityMapping::where('entity_type', $entityType)
            ->where('app_name', $appName)
            ->where('app_record_id', $appRecordId)
            ->first();
    }

    /**
     * Cari global_id yang sudah ada untuk source app tertentu,
     * kalau belum ada, buat baru.
     */
    public function resolveOrCreateGlobalId(string $entityType, string $sourceApp, string $sourceRecordId): string
    {
        $existing = $this->findMapping($entityType, $sourceApp, $sourceRecordId);

        if ($existing) {
            return $existing->global_id;
        }

        return $this->createGlobalId($entityType);
    }

    /**
     * Simpan mapping baru (atau update kalau sudah ada)
     */
    public function saveMapping(string $entityType, string $globalId, string $appName, string $appRecordId, ?string $appRecordKey = null): IntegrationEntityMapping
    {
        return IntegrationEntityMapping::updateOrCreate(
            [
                'entity_type'   => $entityType,
                'app_name'      => $appName,
                'app_record_id' => $appRecordId,
            ],
            [
                'global_id'       => $globalId,
                'app_record_key'  => $appRecordKey,
                'status'          => 'active',
            ]
        );
    }

    /**
     * Cari ID record di aplikasi target berdasarkan global_id
     */
    public function resolveTargetId(string $entityType, string $globalId, string $targetApp): ?string
    {
        $mapping = IntegrationEntityMapping::where('entity_type', $entityType)
            ->where('global_id', $globalId)
            ->where('app_name', $targetApp)
            ->first();

        return $mapping?->app_record_id;
    }
}