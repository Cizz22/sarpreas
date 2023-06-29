<?php

namespace App\Http\Livewire\Admin\Component\Member;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalDetail extends ModalComponent
{
    public $member;
    public $scores;

    public function render()
    {
        return view('livewire.admin.component.member.modal-detail');
    }
}
