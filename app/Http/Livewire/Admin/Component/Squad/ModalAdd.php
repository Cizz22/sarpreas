<?php

namespace App\Http\Livewire\Admin\Component\Squad;

use App\Models\Squad;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalAdd extends ModalComponent
{
    public $name, $unit_id;

    public function render()
    {
        return view('livewire.admin.component.squad.modal-add');
    }

    public function mount($unit_id)
    {
        $this->unit_id = $unit_id;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
        ]);

        Squad::create([
            'name' => $this->name,
            'unit_id' => $this->unit_id,
        ]);

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }
}
