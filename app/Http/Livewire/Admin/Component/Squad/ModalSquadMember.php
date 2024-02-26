<?php

namespace App\Http\Livewire\Admin\Component\Squad;

use App\Models\Squad;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalSquadMember extends ModalComponent
{
    public $unit_id, $squad_id;

    public function render()
    {
        return view('livewire.admin.component.squad.modal-squad-member');
    }

    public function mount($id)
    {
        $this->unit_id = Squad::find($id)->unit_id;
        $this->squad_id = $id;
    }
    public static function modalMaxWidth(): string
    {
        return '6xl';
    }
}
