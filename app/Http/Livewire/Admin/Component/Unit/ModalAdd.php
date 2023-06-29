<?php

namespace App\Http\Livewire\Admin\Component\Unit;

use App\Models\Unit;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class ModalAdd extends ModalComponent
{
    public $name;

    public function render()
    {
        return view('livewire.admin.component.unit.modal-add');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required'
        ]);

        Unit::create([
            'name' => $this->name
        ]);

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }
}
