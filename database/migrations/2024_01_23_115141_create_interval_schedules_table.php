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
        Schema::create('interval_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('squad_id')->constrained('squads')->onDelete('cascade');
            $table->foreignId('shift_schedule_id')->constrained('shift_schedules')->onDelete('cascade');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interval_schedules');
    }
};
