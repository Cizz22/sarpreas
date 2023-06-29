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
        Schema::create('presensi_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subunit_member_id')->constrained('subunit_members')->onDelete('cascade');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpa']);
            $table->string('lat', 100)->nullable();
            $table->string('long', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_members');
    }
};
