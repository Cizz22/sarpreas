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
        $this->passcode = "-";
        $this->coordinator = Member::find($id);
    }

    public function submit()
    {
        $this->validate([
            'password' => 'required',
        ]);

        $checkPassword = Hash::check($this->password, auth()->user()->password);
        if ($checkPassword) {
            $this->passcode = $this->coordinator->user->passcode->passcode;
        } else {
            return $this->addError('password', 'Password salah');
        }
    }

    public function render()
    {
        return view('livewire.admin.component.coordinator.modal-passcode');
    }
}
