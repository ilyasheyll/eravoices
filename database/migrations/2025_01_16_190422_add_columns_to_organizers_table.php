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
        Schema::table('organizers', function (Blueprint $table) {
            $table->string('phone', 18)->after('user_id');
            $table->date('date_birth')->after('phone');
            $table->string('inn', 12)->after('date_birth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organizers', function (Blueprint $table) {
            $table->dropColumn('inn');
            $table->dropColumn('date_birth');
            $table->dropColumn('phone');
        });
    }
};
