<?php

namespace App\Http\Livewire\Admin\Component\CarBooking;

use App\Models\Car;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;

class ModalAddCar extends ModalComponent
{
    use WithFileUploads;

    public $name, $capacity, $vehicle_type, $description, $image, $filepath;

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
            'image' => 'required|image|max:1024'
        ]);

        $this->filepath = null;

        if ($this->image) {
            $file = $this->image;
            $fileName = time() . '_' . $file->getClientOriginalName();
            $this->filepath = $this->image->storeAs('uploads', $fileName, 'public');
        }

        Car::create([
            'name' => $this->name,
            'capacity' => $this->capacity,
            'vehicle_type' => $this->vehicle_type,
            'image' => $this->filepath
        ]);

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);


    }
}
