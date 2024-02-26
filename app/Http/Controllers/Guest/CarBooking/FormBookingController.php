<?php

namespace App\Http\Controllers\Guest\CarBooking;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarBooking;
use Illuminate\Http\Request;

class FormBookingController extends Controller
{
    public $filePath;

    public function index(Request $request)
    {
        if (!$request->carId) {
            return redirect()->route('peminjaman.list-kendaraan');
        }

        $selectedCar = Car::find($request->carId);


        return view('guest.car-booking.form-booking', compact('selectedCar'));
    }

    public function submit(Request $request)
    {
        $validate = [
            'org_name' => 'required',
            'full_name' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'booking_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'reason' => 'required',
        ];

        $this->filePath = null;

        if ($request->hasFile('supporting_documents')) {
            array_push($validate, ['supporting_documents' => 'mimes:pdf,doc,docx,jpg,jpeg,png|max:2048']);
        }

        $this->validate($request, $validate);

        if ($request->hasFile('supporting_documents')) {
            $file = $request->file('supporting_documents');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $this->filePath = $request->file('supporting_documents')->storeAs('uploads', $fileName, 'public');
        }

        // Create random 5 digit string for booking code
        $bookingCode = substr(str_shuffle(str_repeat($x = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5 / strlen($x)))), 1, 5);

        $booking = CarBooking::create([
            'booking_code' => $bookingCode,
            'car_id' => $request->car_id,
            'organization_name' => $request->org_name,
            'person_in_charge_name' => $request->full_name,
            'person_in_charge_phone_number' => $request->no_hp,
            'person_in_charge_email' => $request->email,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'supporting_documents' => $this->filePath,
        ]);


        return redirect()->route('peminjaman.form.success', ['booking_code' => $bookingCode]);
    }

    public function success(Request $request)
    {
        $bookingCode = $request->booking_code;

        return view('guest.car-booking.success-booking', compact('bookingCode'));
    }
}
