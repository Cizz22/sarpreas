<?php

namespace App\Http\Livewire\Admin\Component\Subunit;

use App\Models\SubunitMember;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalAddSubunitMember extends ModalComponent
{
    public $members, $member_id, $subunit_id;

    public function mount($subunit_id)
    {
        $this->subunit_id = $subunit_id;
        $this->members = User::where('roles', 'member')->doesntHave('member.subunitMember')->get();
    }

    public function refreshmembers()
    {
        $this->members = User::where('roles', 'member')->doesntHave('member.subunitMember')->get();
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
            'memberable_id' => $this->member_id,
            'memberable_type' => 'App\Models\Member',
            'subunit_id' => $this->subunit_id,
        ]);

        $this->refreshmembers();

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }
}
