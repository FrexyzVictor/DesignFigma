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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('global_id', 100)->nullable()->unique();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('paket', 100);
            $table->decimal('harga', 15, 2);
            $table->enum('status', ['aktif', 'suspend', 'terminated'])->default('aktif');
            $table->date('tanggal_mulai')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
