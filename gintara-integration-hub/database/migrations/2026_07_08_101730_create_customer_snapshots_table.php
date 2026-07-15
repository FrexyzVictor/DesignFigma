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
        Schema::create('customer_snapshots', function (Blueprint $table) {
            $table->id();
            $table->string('global_customer_id', 100)->unique();
            $table->string('nama', 150)->nullable();
            $table->string('telepon', 50)->nullable();
            $table->text('alamat')->nullable();
            $table->string('status_pelanggan', 50)->nullable();
            $table->string('status_langganan', 50)->nullable();
            $table->string('paket', 100)->nullable();
            $table->decimal('harga_paket', 15, 2)->default(0);
            $table->string('pppoe_username', 100)->nullable();
            $table->string('router', 100)->nullable();
            $table->string('network_status', 50)->nullable();
            $table->string('billing_status', 50)->nullable();
            $table->decimal('outstanding_amount', 15, 2)->default(0);
            $table->dateTime('last_payment_at')->nullable();
            $table->dateTime('last_online_at')->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_snapshots');
    }
};
