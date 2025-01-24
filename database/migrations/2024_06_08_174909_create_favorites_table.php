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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->index('user_id', 'favorite_user_idx');
            $table->foreign('user_id', 'favorite_user_fk')->on('users')->references('id');

            $table->unsignedBigInteger('event_id');
            $table->index('event_id', 'favorite_event_idx');
            $table->foreign('event_id', 'favorite_event_fk')->on('events')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
