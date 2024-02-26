<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'booking_code',
        'organization_name',
        'license_plate',
        'person_in_charge_name',
        'person_in_charge_phone_number',
        'person_in_charge_email',
        'booking_date',
        'start_time',
        'end_time',
        'status',
        'supporting_documents',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function carBookingReturnBorrows()
    {
        return $this->hasOne(CarBookingReturnBorrow::class);
    }
}
