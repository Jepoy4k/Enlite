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
        if (!Schema::hasTable('course_instructor')) {
            Schema::create('course_instructor', function (Blueprint $table) {
                $table->bigIncrements('Course_InstructorID')->primary(); // Primary key
                $table->unsignedBigInteger('InstructorID'); // Foreign key column
                $table->string('CourseID'); // Adds created_at and updated_at columns
                $table->tinyInteger('Drop')->default(0); // 1 = drop ang course || 0 wa na drop


                

                // Foreign key constraints
                $table->foreign('InstructorID')->references('InstructorID')->on('instructors')->onDelete('cascade');
                $table->foreign('CourseID')->references('CourseID')->on('course_management')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_instructor');
    }
};