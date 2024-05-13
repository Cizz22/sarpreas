<?php

namespace App\Http\Livewire\Admin\Component\CarBooking;

use App\Models\Car;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class ModalEditCar extends ModalComponent
{
    use WithFileUploads;

    public $car, $new_image;
    public $name, $capacity, $vehicle_type, $description, $filepath;

    public function render()
    {
        return view('livewire.admin.component.car-booking.modal-edit-car');
    }

    public function mount($car_id)
    {
        $this->car = Car::find($car_id);
        $this->name = $this->car->name;
        $this->vehicle_type = $this->car->vehicle_type;
        $this->capacity = $this->car->capacity;
        $this->filepath = $this->car->image;
    }

    public function submit()
    {

        if ($this->new_image) {
            $this->validate([
                'new_image' => 'required|image|max:1024'
            ]);
        }

        if ($this->new_image) {
            $file = $this->new_image;
            $fileName = time() . '_' . $file->getClientOriginalName();
            $this->filepath = $this->new_image->storeAs('uploads', $fileName, 'public');
        }else {
            $this->filepath = null;
        }

        $this->car->update([
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
