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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate')->unique(); // matrícula
            $table->string('category');                // categoría
            $table->string('brand');                   // marca
            $table->string('model');                   // modelo
            $table->json('dimensions')->nullable();    // dimensiones (JSON)
            $table->string('fuel_type');               // tipo de combustible
            $table->unsignedBigInteger('primary_owner_id')->nullable();
            $table->foreign('primary_owner_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
