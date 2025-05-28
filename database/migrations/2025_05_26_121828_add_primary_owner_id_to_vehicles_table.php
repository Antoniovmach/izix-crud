<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('vehicles', function (Blueprint $table) {
        $table->unsignedBigInteger('primary_owner_id')->nullable()->after('fuel_type');
        $table->foreign('primary_owner_id')->references('id')->on('users')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('vehicles', function (Blueprint $table) {
        $table->dropForeign(['primary_owner_id']);
        $table->dropColumn('primary_owner_id');
    });
}

};
