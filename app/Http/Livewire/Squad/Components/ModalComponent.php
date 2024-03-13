<?php

namespace App\Http\Livewire\Squad\Components;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent as ModalModalComponent;

class ModalComponent extends ModalModalComponent
{
    public $tugas, $squad, $interval_schedule, $type;

    public function render()
    {
        return view('livewire.squad.components.modal-component');
    }

    public function mount($tugas, $interval_schedule, $type = null)
    {
        $this->squad = auth()->user()->squad;
        $this->tugas = $tugas;
        $this->type = $type;
        $this->interval_schedule = $interval_schedule;
    }
}
