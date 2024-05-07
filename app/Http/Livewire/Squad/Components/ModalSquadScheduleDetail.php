<?php

namespace App\Http\Livewire\Squad\Components;

use App\Models\IntervalSchedule;
use Livewire\Component;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class ModalSquadScheduleDetail extends ModalComponent
{
    public $interval_schedule, $dateInput, $reguInput, $shiftInput;

    public function render()
    {
        return view('livewire.squad.components.modal-squad-schedule-detail');
    }

    public function mount($interval_schedule)
    {
        $this->interval_schedule = IntervalSchedule::find($interval_schedule);

        $this->dateInput = Carbon::createFromFormat('Y-m-d', $this->interval_schedule->date)->toDateString();
        $this->shiftInput = $this->interval_schedule->shift_schedule_id;
        $this->reguInput = $this->interval_schedule->squad_id;
    }
}
