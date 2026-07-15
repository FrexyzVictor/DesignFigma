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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('global_id', 100)->nullable()->unique(); // ID dari Integration Hub
            $table->string('nama', 150);
            $table->string('telepon', 50);
            $table->text('alamat')->nullable();
            $table->string('pppoe_username', 100)->nullable();
            $table->enum('status', ['aktif', 'suspend', 'berhenti', 'deleted'])->default('aktif');
            $table->string('sync_status', 30)->default('synced'); // synced, pending, error
            $table->dateTime('last_synced_at')->nullable();
            $table->text('sync_error')->nullable();
            $table->softDeletes(); // otomatis nambah kolom deleted_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
