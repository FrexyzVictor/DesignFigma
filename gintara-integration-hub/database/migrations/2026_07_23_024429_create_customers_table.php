<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {

            $table->id();

            $table->string('global_id')->unique();

            $table->string('nama');

            $table->string('telepon')->nullable();

            $table->text('alamat')->nullable();

            $table->string('pppoe_username')->nullable();

            $table->enum('status', [
                'aktif',
                'nonaktif'
            ])->default('aktif');

            $table->enum('sync_status', [
                'pending',
                'success',
                'failed'
            ])->default('pending');

            $table->timestamp('last_synced_at')
                  ->nullable();

            $table->text('sync_error')
                  ->nullable();

            $table->timestamps();

            $table->softDeletes();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};