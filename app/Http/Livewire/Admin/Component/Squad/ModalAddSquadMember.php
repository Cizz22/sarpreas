<?php

namespace App\Http\Livewire\Admin\Component\Squad;

use App\Models\SquadMember;
use App\Models\User; // Import the User class

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalAddSquadMember extends ModalComponent
{
    public $members, $member_id, $squad_id, $unit_id;

    public function mount($squad_id, $unit_id)
    {
        $this->squad_id = $squad_id;
        $this->unit_id = $unit_id;
        $this->members = User::where('roles', 'member')->doesntHave('member.squadMember')->whereRelation('member', 'unit_id', $this->unit_id)->get();
    }

    public function refreshmembers()
    {
        $this->members = User::where('roles', 'member')->doesntHave('member.squadMember')->whereRelation('member', 'unit_id', $this->unit_id)->get();
    }

    public function render()
    {
        return view('livewire.admin.component.squad.modal-add-squad-member');
    }

    public function submit()
    {
        $this->validate([
            'member_id' => 'required',
        ]);

        SquadMember::create([
            'member_id' => $this->member_id,
            'squad_id' => $this->squad_id,
        ]);

        $this->refreshmembers();

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }
}
