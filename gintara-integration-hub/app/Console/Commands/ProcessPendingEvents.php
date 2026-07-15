<?php

namespace App\Console\Commands;

use App\Models\IntegrationEvent;
use App\Services\EventProcessorService;
use Illuminate\Console\Command;

class ProcessPendingEvents extends Command
{
    protected $signature = 'integration:process-events';
    protected $description = 'Proses semua event pending menjadi mapping + sync job';

    public function handle(EventProcessorService $processor)
    {
        $events = IntegrationEvent::where('status', 'pending')->get();

        if ($events->isEmpty()) {
            $this->info('Tidak ada event pending.');
            return;
        }

        foreach ($events as $event) {
            $this->info("Memproses event: {$event->event_id} ({$event->event_type})");
            $processor->process($event);
        }

        $this->info('Selesai. Total diproses: ' . $events->count());
    }
}