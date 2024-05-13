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

    public function getImageAttribute($image)
    {
        if ($image) {
            return asset("storage/$image");
        } else {
            return "https://generatorfun.com/code/uploads/Random-Car-image-10.jpg";
        }
    }
}
