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
        Schema::create('student_records', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('ci');
            $table->string('representative_full_name');
            $table->string('representative_ci');
            $table->date('date_of_birth');
            $table->smallInteger('gender');
            $table->date('join_date')->nullable();
            $table->integer('grade_code');
            $table->string('section_code');
            $table->foreignId('school_term_id')->constrained('school_terms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_records');
    }
};
