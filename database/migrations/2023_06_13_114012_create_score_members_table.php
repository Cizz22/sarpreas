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
        Schema::create('score_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->foreignId('subunit_id')->nullable()->constrained('subunits')->onDelete('set null');
            $table->foreignId('coordinator_id')->nullable()->constrained('members')->onDelete('set null');
            $table->foreignId('presensi_id')->constrained('presensi_members')->onDelete('cascade');
            $table->date('tanggal_penilaian')->default(today());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_members');
    }
};
