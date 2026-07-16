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
        Schema::create('pppoe_monitorings', function (Blueprint $table) {
            $table->id();
            $table->string('global_id', 100)->nullable()->unique();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('pppoe_username', 100);
            $table->string('router', 100)->nullable();
            $table->enum('network_status', ['online', 'offline'])->default('offline');
            $table->dateTime('last_online_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pppoe_monitorings');
    }
};
