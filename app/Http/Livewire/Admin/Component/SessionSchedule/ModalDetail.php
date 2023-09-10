<?php

namespace App\Http\Livewire\Admin\Component\SessionSchedule;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalDetail extends ModalComponent
{
    public $unit_id;

    public function render()
    {
        return view('livewire.admin.component.session-schedule.modal-detail');
    }

    public function mount($id)
    {
        $this->unit_id = $id;
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }
}
