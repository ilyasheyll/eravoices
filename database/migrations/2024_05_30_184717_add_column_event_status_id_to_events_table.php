<?php

use App\Models\EventStatus;
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
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('event_status_id')->nullable();
            $table->index('event_status_id', 'event_event_status_idx');
            $table->foreign('event_status_id', 'event_event_status_fk')->on('event_statuses')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('event_event_status_fk');
            $table->dropIndex('event_event_status_idx');
            $table->dropColumn('event_status_id');
        });
    }
};
