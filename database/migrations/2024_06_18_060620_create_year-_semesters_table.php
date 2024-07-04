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
        Schema::create('year_semester', function (Blueprint $table) {
            $table->bigIncrements('Year_SemID')->primary();
            $table->integer('YearLevel');
            $table->string('Sem', 40);
         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('year_semester');
    }
};
