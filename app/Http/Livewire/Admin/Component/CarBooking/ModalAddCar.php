<?php

namespace App\Http\Livewire\Admin\Component\CarBooking;

use App\Models\Car;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalAddCar extends ModalComponent
{
    public $name, $capacity, $vehicle_type, $description, $image;

    public function render()
    {
        return view('livewire.admin.component.car-booking.modal-add-car');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'capacity' => 'required',
            'vehicle_type' => 'required',
        ]);

        Car::create([
            'name' => $this->name,
            'capacity' => $this->capacity,
            'vehicle_type' => $this->vehicle_type,
        ]);

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }
}
