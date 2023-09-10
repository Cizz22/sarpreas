<?php

namespace App\Http\Livewire\Admin\Component\Member;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalAdd extends ModalComponent
{
    public $name;
    public $no_hp;
    public $unit_id;
    public $units;

    public function render()
    {
        return view('livewire.admin.component.member.modal-add');
    }

    public function mount()
    {
        $this->units = \App\Models\Unit::all();
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'no_hp' => 'required',
            'unit_id' => 'required',
        ]);

        //create password at least 8 characters from random string
        $password = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8 / strlen($x)))), 1, 8);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->name . '@gmail.com',
            'roles' => 'member',
            'password' => bcrypt($password),
        ]);

        $user->member()->create([
            'name' => $this->name,
            'no_hp' => $this->no_hp,
            'unit_id' => $this->unit_id,
        ]);

        \App\Models\Passcode::generatePasscode($user->id);


        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }
}
