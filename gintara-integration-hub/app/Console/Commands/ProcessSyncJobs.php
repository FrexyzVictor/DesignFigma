<?php

namespace App\Console\Commands;

use App\Models\IntegrationSyncJob;
use App\Models\IntegrationLog;
use App\Services\Adapters\ManagementAdapter;
use App\Services\Adapters\BillingAdapter;
use App\Services\Adapters\PulseBoardAdapter;
use App\Services\Adapters\WiFiKulaAdapter;
use Illuminate\Console\Command;

class ProcessSyncJobs extends Command
{
    protected $signature = 'integration:sync-jobs';
    protected $description = 'Kirim data dari sync_jobs pending/retry ke aplikasi target via adapter';

    public function handle()
    {
        $jobs = IntegrationSyncJob::whereIn('status', ['pending', 'retry'])->get();

        if ($jobs->isEmpty()) {
            $this->info('Tidak ada sync job pending.');
            return;
        }

        foreach ($jobs as $job) {
            $this->info("Sync job #{$job->id} -> {$job->target_app} ({$job->action})");
            $this->processJob($job);
        }

        $this->info('Selesai. Total job diproses: ' . $jobs->count());
    }

    protected function processJob(IntegrationSyncJob $job): void
    {
        $job->update(['status' => 'processing']);

        $adapter = $this->getAdapter($job->target_app);

        if (!$adapter) {
            $job->update([
                'status'        => 'failed_permanent',
                'error_message' => "Adapter untuk {$job->target_app} tidak ditemukan.",
            ]);
            return;
        }

        $payload = json_decode($job->payload, true);
        $payload['global_id'] = $job->global_id;

        try {
            $result = match ($job->action) {
                'create'      => $adapter->create($job->entity_type, $payload),
                'update'      => $adapter->update($job->entity_type, $job->global_id, $payload),
                'soft_delete' => $adapter->softDelete($job->entity_type, $job->global_id),
                default       => ['success' => false, 'status' => 0, 'body' => null],
            };

            IntegrationLog::create([
                'source_app'        => $job->source_app,
                'target_app'        => $job->target_app,
                'endpoint'          => $job->target_app,
                'method'            => 'POST',
                'request_payload'   => json_encode($payload),
                'response_payload'  => json_encode($result['body'] ?? null),
                'http_status'       => $result['status'] ?? null,
                'status'            => $result['success'] ? 'success' : 'failed',
                'error_message'     => $result['success'] ? null : 'Non-success HTTP response',
            ]);

            if ($result['success']) {
                $job->update(['status' => 'success', 'processed_at' => now()]);
            } else {
                $this->markRetryOrFail($job, 'HTTP gagal, status: ' . ($result['status'] ?? 'unknown'));
            }
        } catch (\Throwable $e) {
            IntegrationLog::create([
                'source_app'      => $job->source_app,
                'target_app'      => $job->target_app,
                'endpoint'        => $job->target_app,
                'method'          => 'POST',
                'request_payload' => json_encode($payload),
                'status'          => 'failed',
                'error_message'   => $e->getMessage(),
            ]);

            $this->markRetryOrFail($job, $e->getMessage());
        }
    }

    protected function markRetryOrFail(IntegrationSyncJob $job, string $error): void
    {
        $newRetryCount = $job->retry_count + 1;

        if ($newRetryCount >= $job->max_retry) {
            $job->update([
                'status'        => 'failed_permanent',
                'retry_count'   => $newRetryCount,
                'error_message' => $error,
            ]);
        } else {
            $job->update([
                'status'        => 'retry',
                'retry_count'   => $newRetryCount,
                'error_message' => $error,
            ]);
        }
    }

    protected function getAdapter(string $targetApp)
    {
        return match ($targetApp) {
            'management' => app(ManagementAdapter::class),
            'billing'    => app(BillingAdapter::class),
            'pulseboard' => app(PulseBoardAdapter::class),
            'wifikula'   => app(WiFiKulaAdapter::class),
            default      => null,
        };
    }
}