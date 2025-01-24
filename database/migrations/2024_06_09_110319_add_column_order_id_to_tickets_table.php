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
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->after('id');
            $table->index('order_id', 'ticket_order_idx');
            $table->foreign('order_id', 'ticket_order_fk')->on('orders')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign('ticket_order_fk');
            $table->dropIndex('ticket_order_idx');
            $table->dropColumn('order_id');
        });
    }
};
