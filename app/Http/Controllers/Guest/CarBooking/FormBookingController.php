<?php

namespace App\Http\Controllers\Guest\CarBooking;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarBooking;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        ];

        // Check if start time is before end time
        if (strtotime($request->start_time) >= strtotime($request->end_time)) {
            throw ValidationException::withMessages(['start_time' => 'Start time must be before end time.']);
        }

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

        $existingBookings = CarBooking::where('car_id', $request->car_id)
            ->where('booking_date', $request->booking_date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })
            ->exists();

        if ($existingBookings) {
            throw ValidationException::withMessages(['start_time' => 'Kendaraan tidak tersedia pada tanggal dan waktu yang diminta']);
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
