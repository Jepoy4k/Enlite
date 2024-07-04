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
        Schema::create('all_users', function (Blueprint $table) {
            $table->bigIncrements('UserID')->primary();
            $table->unsignedBigInteger('RoleID');
            $table->string('Username');
            $table->string('Password');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('RoleID')->references('RoleID')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_users');
    }
};
