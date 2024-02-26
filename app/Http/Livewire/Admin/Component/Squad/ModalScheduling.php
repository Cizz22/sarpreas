<?php

namespace App\Http\Livewire\Admin\Component\Squad;

use App\Models\IntervalSchedule;
use App\Models\ShiftSchedule;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalScheduling extends ModalComponent
{
    public $squad_id;
    public $shift_schedules;
    public $schedule_id;

    public function render()
    {
        return view('livewire.admin.component.squad.modal-scheduling');
    }

    public function mount($squad_id)
    {
        $this->squad_id = $squad_id;
        $this->shift_schedules = ShiftSchedule::all();
    }

    public function submit()
    {
        $this->validate([
            'schedule_id' => 'required',
        ]);

        IntervalSchedule::create([
            'squad_id' => $this->squad_id,
            'shift_schedule_id' => $this->schedule_id,
        ]);

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }
}
