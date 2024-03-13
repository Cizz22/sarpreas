<?php

namespace App\Http\Livewire\Admin\Component\Utils;

use App\Models\SubunitMember;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use PHPUnit\Event\Code\Throwable;

class ModalDelete extends ModalComponent
{
    public $model;

    public function render()
    {
        return view('livewire.admin.component.utils.modal-delete');
    }

    public function mount($model, $id)
    {
        $this->model = app($model)->find($id);
    }

    public function delete()
    {
        try {
            if ($this->model instanceof \App\Models\Member) {
                $this->model->user->delete();
                if ($this->model->subunitMember) {
                    $this->model->subunitMember->delete();
                }
            }

            $this->model->delete();

            $this->closeModalWithEvents([
                'pg:eventRefresh-default',
            ]);
        } catch (\Throwable $th) {
            dd($this->model->id);
        }
    }
}
