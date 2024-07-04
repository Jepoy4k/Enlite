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
        if (!Schema::hasTable('Grade')) {
            Schema::create('Grade', function (Blueprint $table) {
                $table->bigIncrements('GradeID')->primary();
                $table->unsignedBigInteger('StudentID');
                $table->unsignedBigInteger('Course_InstructorID');
                $table->float('Midterm');
                $table->float('Final');
                

                
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
        Schema::dropIfExists('Grade');
    }
};