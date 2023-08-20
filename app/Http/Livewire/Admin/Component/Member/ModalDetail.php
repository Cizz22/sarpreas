<?php

namespace App\Http\Livewire\Admin\Component\Member;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalDetail extends ModalComponent
{
    public $member;

    public function mount($id)
    {
        $this->member = \App\Models\Member::find($id);
    }

    public function render()
    {
        return view('livewire.admin.component.member.modal-detail');
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }
}
