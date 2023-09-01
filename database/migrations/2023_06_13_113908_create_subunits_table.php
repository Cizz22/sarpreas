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
        Schema::create('subunits', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->foreignId('coordinator_id')->nullable()->constrained('members')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subunits');
    }
};
