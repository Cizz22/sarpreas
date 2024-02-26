<?php

namespace App\Http\Livewire\Admin\Component\Squad;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalSquad extends ModalComponent
{
    public $unit_id;

    public function render()
    {
        return view('livewire.admin.component.squad.modal-squad');
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
