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
        Schema::create('organization_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organizer_id');
            $table->index('organizer_id', 'organization_detail_organizer_idx');
            $table->foreign('organizer_id', 'organization_detail_organizer_fk')->on('organizers')->references('id');

            $table->string('name', 100);
            $table->string('mailing_address');
            $table->string('legal_address');
            $table->string('email');
            $table->string('phone', 18);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_details');
    }
};
