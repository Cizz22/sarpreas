<?php

namespace App\Http\Livewire\Admin\Component\CarBooking;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalDetail extends ModalComponent
{
    public $carBookingId;

    public function render()
    {
        return view('livewire.admin.component.car-booking.modal-detail');
    }

    public function mount($carBookingId){
        $this->carBookingId = $carBookingId;
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }
}
