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
        Schema::create('integration_entity_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type', 50);
            $table->string('global_id', 100);
            $table->string('app_name', 50);
            $table->string('app_record_id', 100);
            $table->string('app_record_key', 150)->nullable();
            $table->string('status', 30)->default('active');
            $table->timestamps();

            $table->unique(['entity_type', 'app_name', 'app_record_id'], 'uniq_mapping');
            $table->index('global_id', 'idx_global_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integration_entity_mappings');
    }
};
