<?php

namespace App\Http\Livewire\Admin\Component\CarBooking;

use App\Models\CarBooking;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalAccept extends ModalComponent
{
    public $car_booking_id, $type, $licence_number;

    public function render()
    {
        return view('livewire.admin.component.car-booking.modal-accept');
    }

    public function mount($car_booking_id, $type)
    {
        $this->car_booking_id = $car_booking_id;
        $this->type = $type;
    }

    public function submit()
    {
        $car_booking = CarBooking::find($this->car_booking_id);

        if ($this->type == "accept") {
            $this->validate([
                'licence_number' => 'required'
            ]);

            $car_booking->status = 'approved';
            $car_booking->license_plate = $this->licence_number;
            $car_booking->save();
        } else {
            $car_booking->status = 'rejected';
            $car_booking->save();
        }

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }
}
