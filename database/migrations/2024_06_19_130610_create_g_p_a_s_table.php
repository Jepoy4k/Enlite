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
        Schema::create('GPA', function (Blueprint $table) {
            $table->bigIncrements('GPAID')->primary();
                $table->unsignedBigInteger('StudentID'); // Foreign key column
                $table->float('GPA');
                $table->string('Remarks', 50);
                
                
                $table->foreign('StudentID')->references('StudentID')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('GPA');
    }
};
