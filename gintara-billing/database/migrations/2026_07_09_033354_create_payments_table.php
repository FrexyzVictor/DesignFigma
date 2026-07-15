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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->string('global_id', 100)->nullable()->unique();
        $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade');
        $table->decimal('jumlah', 15, 2);
        $table->dateTime('paid_at');
        $table->enum('status', ['paid', 'cancelled'])->default('paid');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
