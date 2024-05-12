<?php

namespace App\Http\Livewire\Admin\Component\CarBooking;

use App\Models\Car;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalCarImage extends ModalComponent
{
    public $car;

    public function render()
    {
        return view('livewire.admin.component.car-booking.modal-car-image');
    }

    public function mount($car_id){
        $this->car = Car::find($car_id);
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }
}
