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
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->foreignId('subunits_id')->nullable()->constrained('subunits')->onDelete('set null');
            $table->foreignId('coordinator_id')->nullable()->constrained('members')->onDelete('set null');
            $table->date('tanggal_presensi')->default(today());
            $table->enum('status', ['Hadir', 'Izin', 'Alpha'])->default('Alpha');
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
