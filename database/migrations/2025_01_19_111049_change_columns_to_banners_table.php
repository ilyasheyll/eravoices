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
        Schema::table('banners', function (Blueprint $table) {
            $table->foreignId('event_id')->nullable()->change();
            $table->string('image')->nullable()->after('min_descr');
            $table->string('link')->nullable()->after('image');
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('active');
            $table->dropColumn('link');
            $table->dropColumn('image');
            $table->foreignId('event_id')->nullable(false)->change();
        });
    }
};
