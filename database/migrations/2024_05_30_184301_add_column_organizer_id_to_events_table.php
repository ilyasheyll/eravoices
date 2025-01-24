<?php

use App\Models\Organizer;
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
            $table->unsignedBigInteger('organizer_id')->nullable()->after('category_id');
            $table->index('organizer_id', 'event_organizer_idx');
            $table->foreign('organizer_id', 'event_organizer_fk')->on('organizers')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('event_organizer_fk');
            $table->dropIndex('event_organizer_idx');
            $table->dropColumn('organizer_id');
        });
    }
};
