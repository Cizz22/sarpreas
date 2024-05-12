<?php

namespace App\Http\Livewire\Guest\Component;

use Carbon\Carbon;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DateModal extends ModalComponent
{
    public $currentMonth, $currentYear, $bookedDates, $currentDate;

    public function render()
    {
        return view('livewire.guest.component.date-modal');
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
}
