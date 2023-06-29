<?php

namespace App\Http\Livewire\Admin\Component\Instrument;

use App\Models\Instrument;
use App\Models\Unit;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalAdd extends ModalComponent
{
    public $instrument;
    public $unit_id;
    public $unit;

    public function render()
    {
        return view('livewire.admin.component.instrument.modal-add');
    }

    public function mount()
    {
        $this->unit = Unit::all();
    }

    public function submit()
    {
        $this->validate([
            'instrument' => 'required',
            'unit_id' => 'required',
        ]);

        Instrument::create([
            'instrument' => $this->instrument,
            'unit_id' => $this->unit_id,
        ]);

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }
}
