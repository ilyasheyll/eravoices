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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->index('event_id', 'price_event_idx');
            $table->foreign('event_id', 'price_event_fk')->on('events')->references('id');

            $table->unsignedBigInteger('zone_id');
            $table->index('zone_id', 'price_zone_idx');
            $table->foreign('zone_id', 'price_zone_fk')->on('zones')->references('id');

            $table->integer('price_value')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
