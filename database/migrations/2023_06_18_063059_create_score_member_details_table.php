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
        Schema::create('score_member_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('score_member_id')->constrained('score_members')->onDelete('cascade');
            $table->foreignId('instrument_id')->constrained('instruments')->onDelete('cascade');
            $table->integer('score')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_member_details');
    }
};
