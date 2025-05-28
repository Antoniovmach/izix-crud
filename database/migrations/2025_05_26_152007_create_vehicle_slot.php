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
        Schema::create('vehicle_slot', function (Blueprint $table) {
         $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
$table->foreignId('slot_id')->constrained('slots')->onDelete('cascade');
            $table->timestamp('parked_at')->nullable();
            $table->timestamp('left_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_slot');
    }
};
