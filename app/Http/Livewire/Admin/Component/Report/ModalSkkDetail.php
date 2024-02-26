<?php

namespace App\Http\Livewire\Admin\Component\Report;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalSkkDetail extends ModalComponent
{
    public $session_schedule_id;


    public function render()
    {
        return view('livewire.admin.component.report.modal-skk-detail');
    }

    public function mount($id)
    {
        $this->session_schedule_id = $id;
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }
}
