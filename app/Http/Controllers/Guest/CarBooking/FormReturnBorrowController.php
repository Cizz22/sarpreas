<?php

namespace App\Http\Controllers\Guest\CarBooking;

use App\Http\Controllers\Controller;
use App\Models\CarBooking;
use Illuminate\Http\Request;

class FormReturnBorrowController extends Controller
{
    public function index()
    {
        return view('guest.car-booking.form-borrow-return');
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'booking_code' => 'required',
            'borrow_date' => 'required',
            'full_name' => 'required',
            'no_hp' => 'required',
        ]);

        $booking = CarBooking::where('booking_code', $request->booking_code)->first();

        if ($booking->status != 'approved') {
            return redirect()->back()->with('error', 'Kode peminjaman tidak valid');
        }

        $booking->carBookingReturnBorrows()->create([
            'borrow_date' => $request->borrow_date,
            'person_in_charge_name' => $request->full_name,
            'person_in_charge_phone_number' => $request->no_hp,
        ]);

        return "success";
    }
}
