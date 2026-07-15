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
    Schema::create('invoices', function (Blueprint $table) {
        $table->id();
        $table->string('global_id', 100)->nullable()->unique();
        $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
        $table->string('no_invoice', 50)->unique();
        $table->decimal('jumlah', 15, 2);
        $table->date('jatuh_tempo');
        $table->enum('status', ['unpaid', 'paid', 'overdue', 'cancelled'])->default('unpaid');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
