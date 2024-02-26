<?php

namespace App\Http\Controllers\Guest\CarBooking;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class ListCarController extends Controller
{
    public function index()
    {
        $cars = Car::all();


        return view('guest.car-booking.list-car', compact('cars'));
    }
}
