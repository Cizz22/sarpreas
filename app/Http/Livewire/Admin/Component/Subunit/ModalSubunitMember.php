<?php

namespace App\Http\Livewire\Admin\Component\Subunit;

use App\Models\Subunit;
use App\Models\SubunitMember;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalSubunitMember extends ModalComponent
{
    public $subunit_id;

    public function render()
    {
        return view('livewire.admin.component.subunit.modal-subunit-member');
    }

    public function mount($id)
    {
        $this->subunit_id = $id;
    }
    public static function modalMaxWidth(): string
    {
        return '6xl';
    }
}
