<?php

namespace App\Http\Livewire\Admin\Component\Squad;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalSquadSchedule extends ModalComponent
{
    public $squad_id;

    public function render()
    {
        return view('livewire.admin.component.squad.modal-squad-schedule');
    }

    public function mount($id)
    {
        $this->squad_id = $id;
        info($this->squad_id);
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }
}
