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
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zone_type_id');
            $table->index('zone_type_id', 'zone_zone_type_idx');
            $table->foreign('zone_type_id', 'zone_zone_type_fk')->on('zone_types')->references('id');
            $table->string('name', 25);
            $table->integer('count_tickets')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zones');
    }
};
