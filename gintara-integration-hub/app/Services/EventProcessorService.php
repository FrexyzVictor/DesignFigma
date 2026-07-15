<?php

namespace App\Services;

use App\Models\IntegrationEvent;
use App\Models\IntegrationSyncJob;
use App\Models\CustomerSnapshot;
use Illuminate\Support\Facades\Log;

class EventProcessorService
{
    public function __construct(protected MappingService $mappingService)
    {
    }

    /**
     * Proses satu event: bikin/mapping global_id, bikin sync job ke target apps,
     * update snapshot kalau entity_type = customer.
     */
    public function process(IntegrationEvent $event): void
    {
        $event->update(['status' => 'processing']);

        try {
            $data = json_decode($event->payload, true);

            // 1. Resolve / buat global_id
            $globalId = $this->mappingService->resolveOrCreateGlobalId(
                $event->entity_type,
                $event->source_app,
                $event->source_record_id ?? 'unknown'
            );

            // 2. Simpan mapping untuk source app
            $this->mappingService->saveMapping(
                $event->entity_type,
                $globalId,
                $event->source_app,
                $event->source_record_id ?? 'unknown',
                $data['pppoe_username'] ?? $data['telepon'] ?? null
            );

            // 3. Tentukan target apps dari config
            $targets = config("gintara.sync_targets.{$event->entity_type}", []);

            // 4. Buat sync job untuk setiap target (kecuali source_app sendiri)
            foreach ($targets as $targetApp) {
                if ($targetApp === $event->source_app) {
                    continue;
                }

                $action = match (true) {
                    str_ends_with($event->event_type, '.deleted') => 'soft_delete',
                    str_ends_with($event->event_type, '.updated') => 'update',
                    default => 'create',
                };

                IntegrationSyncJob::create([
                    'event_id'    => $event->event_id,
                    'source_app'  => $event->source_app,
                    'target_app'  => $targetApp,
                    'action'      => $action,
                    'entity_type' => $event->entity_type,
                    'global_id'   => $globalId,
                    'payload'     => json_encode($data),
                    'status'      => 'pending',
                ]);
            }

            // 5. Update customer_snapshots kalau entity-nya customer
            if ($event->entity_type === 'customer') {
                CustomerSnapshot::updateOrCreate(
                    ['global_customer_id' => $globalId],
                    [
                        'nama'              => $data['nama'] ?? null,
                        'telepon'           => $data['telepon'] ?? null,
                        'alamat'            => $data['alamat'] ?? null,
                        'status_pelanggan'  => $data['status'] ?? null,
                        'paket'             => $data['paket'] ?? null,
                        'harga_paket'       => $data['harga'] ?? 0,
                        'pppoe_username'    => $data['pppoe_username'] ?? null,
                    ]
                );
            }

            $event->update([
                'status'       => 'success',
                'global_id'    => $globalId,
                'processed_at' => now(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Event processing failed: ' . $e->getMessage());
            $event->update([
                'status'        => 'failed',
                'error_message' => $e->getMessage(),
            ]);
        }
    }
}