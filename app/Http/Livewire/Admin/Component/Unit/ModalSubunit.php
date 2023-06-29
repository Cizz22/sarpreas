<?php

namespace App\Http\Livewire\Admin\Component\Unit;

use App\Models\Unit;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class ModalSubunit extends ModalComponent
{
    public $unit_id;

    public function mount($id){
        $this->unit_id = $id;
    }

    public function render()
    {
        return view('livewire.admin.component.unit.modal-subunit');
    }

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }
}
