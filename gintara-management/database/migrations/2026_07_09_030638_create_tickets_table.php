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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('global_id', 100)->nullable()->unique();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('judul', 200);
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['open', 'in_progress', 'closed', 'cancelled'])->default('open');
            $table->string('source_app', 50)->default('management'); // bisa dari wifikula juga
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
