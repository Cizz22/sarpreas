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
        Schema::create('car_booking_return_borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_booking_id')->constrained('car_bookings')->onDelete('cascade');
            $table->string('person_in_charge_name');
            $table->string('person_in_charge_phone_number');
            $table->string('gasoline_paycheck')->nullable();
            $table->datetime('return_date')->nullable();
            $table->datetime('borrow_date')->nullable();
            $table->enum('status', ['return', 'borrow'])->default('borrow');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_booking_return_borrows');
    }
};
