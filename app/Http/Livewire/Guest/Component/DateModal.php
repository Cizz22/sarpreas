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

    public function mount()
    {
        $this->currentDate = Carbon::now();
        $this->currentMonth = $this->currentDate->format('m');
        $this->currentYear = $this->currentDate->format('y');
    }

    public function changeMonth($type)
    {
        if ($type == "prev") {
            $this->currentMonth--;
        } elseif ($type == "next") {
            $this->currentMonth++;
        }


        if ($this->currentMonth < 0) {
            $this->currentMonth = 11;
            $this->currentYear--;
        } elseif ($this->currentMonth > 11) {
            $this->currentMonth = 0;
            $this->currentYear++;
        }

        $this->emit('generateCalendar', [
            "year" => $this->currentYear,
            "month" => $this->currentMonth
        ]);
    }

    public function generateCalender($year, $month)
    {
    }

    // const currentDate = new Date();
    // let currentYear = currentDate.getFullYear();
    // let currentMonth = currentDate.getMonth();
    // let bookedDates = {{ }}

    // generateCalendar(currentYear, currentMonth);

    // // Event listeners for previous and next month buttons
    // document.getElementById('prevMonth').addEventListener('click', () => {
    //     currentMonth--;
    //     if (currentMonth < 0) {
    //         currentMonth = 11;
    //         currentYear--;
    //     }
    //     generateCalendar(currentYear, currentMonth);
    // });

    // document.getElementById('nextMonth').addEventListener('click', () => {
    //     currentMonth++;
    //     if (currentMonth > 11) {
    //         currentMonth = 0;
    //         currentYear++;
    //     }
    //     generateCalendar(currentYear, currentMonth);
    // });


}
