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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->index('user_id', 'ticket_user_idx');
            $table->foreign('user_id', 'ticket_user_fk')->on('users')->references('id');

            $table->unsignedBigInteger('seat_id');
            $table->index('seat_id', 'ticket_seat_idx');
            $table->foreign('seat_id', 'ticket_seat_fk')->on('seats')->references('id');

            $table->unsignedBigInteger('price_id');
            $table->index('price_id', 'ticket_price_idx');
            $table->foreign('price_id', 'ticket_price_fk')->on('prices')->references('id');

            $table->string('status', 45);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
