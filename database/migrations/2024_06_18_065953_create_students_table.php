<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('students')) {
            Schema::create('students', function (Blueprint $table) {
                $table->bigIncrements('StudentID'); // Primary key
                $table->unsignedBigInteger('UserID'); // Foreign key column
                $table->string('FirstName', 50);
                $table->string('MiddleName', 50)->nullable(); 
                $table->string('LastName', 50);
                $table->string('Email', 255); 
                $table->string('Address', 255); 
                $table->date('Birthdate');
                $table->string('ContactNumber', 20); 
                $table->string('EnrollmentStatus', 50)->nullable();
                $table->timestamps(); 

                // Foreign key constraints
                $table->foreign('UserID')->references('UserID')->on('all_users')->onDelete('cascade');
            });
        } else {
            Schema::table('students', function (Blueprint $table) {
                $table->timestamps(); // Adds created_at and updated_at columns if the table already exists
            });
        }
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
