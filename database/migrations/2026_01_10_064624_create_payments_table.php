<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('prescription_id')->constrained('prescriptions');
            $table->integer('amount_due')->nullable();
            $table->integer('amount_paid')->nullable();
            $table->enum('status', ['belum_dibayar', 'sebagian', 'lunas', 'dibatalkan']);
            $table->enum('method', ['tunai', 'kartu', 'transfer', 'qris', '-'])->nullable();
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
