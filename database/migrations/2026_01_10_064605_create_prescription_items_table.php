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
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('prescription_id')->constrained('prescriptions');
            $table->uuid('medicine_id');
            $table->string('medicine_name');
            $table->integer('quantity');
            $table->integer('unit_price');
            $table->integer('dosage_frequency');
            $table->integer('dosage_amount');
            $table->enum('dosage_unit', ['tablet', 'kapsul', 'saset', 'sendok']);
            $table->string('additional_instruction');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_items');
    }
};
