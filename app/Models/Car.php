<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'vehicle_type',
        'capacity',
        'image',
        'description',
    ];


    public function carBookings()
    {
        return $this->hasMany(CarBooking::class);
    }
}
