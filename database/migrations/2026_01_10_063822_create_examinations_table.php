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
        Schema::create('examinations', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('doctor_id')->constrained('users');
            $table->foreignUuid('patient_id')->constrained('patients');

            $table->date('examined_at');
            $table->text('chief_complaint');
            $table->enum('general_condition', ['baik', 'sedang', 'buruk']);
            $table->enum('consciousness', ['compos_mentis', 'apatis', 'somnolen', 'sopor', 'koma']);
            $table->decimal('height_cm', 8, 2);
            $table->decimal('weight_kg', 8, 2);
            $table->smallInteger('systole');
            $table->smallInteger('diastole');
            $table->smallInteger('heart_rate');
            $table->smallInteger('respiratory_rate');
            $table->decimal('temperature_c', 8, 2);
            $table->text('diagnosis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examinations');
    }
};
