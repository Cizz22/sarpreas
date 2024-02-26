<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBookingReturnBorrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_booking_id',
        'person_in_charge_name',
        'person_in_charge_phone_number',
        'gasoline_paycheck',
        'return_date',
        'borrow_date',
        'status',
    ];

    public function carBooking()
    {
        return $this->belongsTo(CarBooking::class);
    }
}
