<?php

namespace App\Http\Livewire\Admin\Component\Subunit;

use App\Models\SubunitMember;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalAddSubunitMember extends ModalComponent
{
    public $members, $member_id, $subunit_id, $unit_id;

    public function mount($subunit_id, $unit_id)
    {
        $this->subunit_id = $subunit_id;
        $this->unit_id = $unit_id;
        $this->members = User::where('roles', 'member')->doesntHave('member.subunitMember')->whereRelation('member', 'unit_id', $this->unit_id)->get();
    }

    public function refreshmembers()
    {
        $this->members = User::where('roles', 'member')->doesntHave('member.subunitMember')->whereRelation('member', 'unit_id', $this->unit_id)->get();
    }

    public function render()
    {
        return view('livewire.admin.component.subunit.modal-add-subunit-member');
    }

    public function submit()
    {
        $this->validate([
            'member_id' => 'required',
        ]);

        SubunitMember::create([
            'member_id' => $this->member_id,
            'subunit_id' => $this->subunit_id,
        ]);

        $this->refreshmembers();

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }
}
