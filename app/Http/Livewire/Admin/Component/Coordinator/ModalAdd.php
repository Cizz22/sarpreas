<?php

namespace App\Http\Livewire\Admin\Component\Coordinator;

use App\Models\Unit;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalAdd extends ModalComponent
{
    public $name, $no_hp;

    public function render()
    {
        return view('livewire.admin.component.coordinator.modal-add');
    }


    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'no_hp' => 'required',
        ]);

        //create password at least 8 characters from random string
        $password = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8 / strlen($x)))), 1, 8);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->name . '@gmail.com',
            'roles' => 'coordinator',
            'password' => bcrypt($password),
        ]);

        $user->member()->create([
            'name' => $this->name,
            'no_hp' => $this->no_hp,
        ]);

        \App\Models\Passcode::generatePasscode($user->id);


        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }
}
