<?php

namespace App\Http\Livewire\Admin\Component\Subunit;

use App\Models\Subunit;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalAdd extends ModalComponent
{
    public $coordinators, $name, $coordinator_id, $unit_id;

    public function mount($unit_id)
    {
        $this->unit_id = $unit_id;
        $this->coordinators = User::where('roles', 'coordinator')->doesntHave('member.coordinator')->get();
    }

    public function refreshCoordinators()
    {
        $this->coordinators = User::where('roles', 'coordinator')->doesntHave('member.coordinator')->get();
    }

    public function render()
    {
        return view('livewire.admin.component.subunit.modal-add');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'coordinator_id' => 'required',
        ]);

        Subunit::create([
            'name' => $this->name,
            'coordinator_id' => $this->coordinator_id,
            'unit_id' => $this->unit_id,
        ]);

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }
}
