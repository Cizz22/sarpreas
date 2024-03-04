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
        Schema::create('session_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->foreignId('interval_schedule_id')->constrained('interval_schedules')->onDelete('cascade');
            $table->enum('status', ["Belum Dilakukan", "Sedang Dilakukan", "Sudah Dilakukan"])->default('Belum Dilakukan');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('type')->nullable(); //Patroli, Pos, Gedung
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_schedules');
    }
};
