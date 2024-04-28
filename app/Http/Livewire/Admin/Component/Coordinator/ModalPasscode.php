<?php

namespace App\Http\Livewire\Admin\Component\Coordinator;

use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalPasscode extends ModalComponent
{
    public $passcode, $password, $coordinator;

    public function mount($id)
    {
        $this->passcode = $this->coordinator->user->passcode->passcode;;
        $this->coordinator = Member::find($id);
    }


    public function render()
    {
        return view('livewire.admin.component.coordinator.modal-passcode');
    }
}
