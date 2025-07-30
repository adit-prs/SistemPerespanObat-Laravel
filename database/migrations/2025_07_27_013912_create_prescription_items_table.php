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
            $table->uuid('prescription_id');
            $table->uuid('medicine_id');
            $table->string('medicine_name');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('dosage');
            $table->string('frequency');
            $table->integer('duration');
            $table->string('dosage_schedule');
            $table->string('instructions');
            $table->timestamps();
            $table->foreign('prescription_id')
                ->references('id')
                ->on('prescriptions')
                ->onUpdate('cascade')->onDelete('cascade');
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
