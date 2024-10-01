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
        Schema::create('student_medical_records', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->string('medical_condition');
            $table->text('treatment')->nullable();
            $table->text('notes')->nullable();
            $table->string('allergies')->nullable();
            $table->string('medications')->nullable();
            $table->string('vaccines')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_medical_records');
    }
};
