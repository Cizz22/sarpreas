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
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->foreignId('member_1_id')->constrained('members')->onDelete('cascade');
            $table->foreignId('member_2_id')->constrained('members')->onDelete('cascade');
            $table->enum('shift', ['Pagi', 'Siang', 'Malam']);
            $table->enum('status', ["Belum dilakukan", "Sedang dilakukan", "Sudah Dilakukan"])->default('Belum Dilakukan');
            $table->date('date');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
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
