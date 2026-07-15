<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('integration_sync_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('event_id', 100);
            $table->string('source_app', 50);
            $table->string('target_app', 50);
            $table->enum('action', ['create', 'update', 'soft_delete', 'restore', 'sync']);
            $table->string('entity_type', 50);
            $table->string('global_id', 100)->nullable();
            $table->longText('payload');
            $table->enum('status', ['pending', 'processing', 'success', 'failed', 'retry', 'failed_permanent'])->default('pending');
            $table->integer('retry_count')->default(0);
            $table->integer('max_retry')->default(3);
            $table->text('error_message')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->dateTime('processed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integration_sync_jobs');
    }
};
