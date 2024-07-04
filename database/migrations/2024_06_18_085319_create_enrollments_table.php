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
        if (!Schema::hasTable('Enrollments')) {
            Schema::create('Enrollments', function (Blueprint $table) {
                $table->bigIncrements('EnrollmentID')->primary();
                $table->unsignedBigInteger('Year_SemID'); // Foreign key column
                $table->unsignedBigInteger('StudentID');
                $table->unsignedBigInteger('Course_InstructorID');
                $table->timestamps();
                
                $table->foreign('Year_SemID')->references('Year_SemID')->on('year_semester')->onDelete('cascade');
                $table->foreign('StudentID')->references('StudentID')->on('students')->onDelete('cascade');
                $table->foreign('Course_InstructorID')->references('Course_InstructorID')->on('course_instructor')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Enrollments');
    }
};