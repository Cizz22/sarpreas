<?php

namespace App\Http\Livewire\Admin\Component\Utils;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalEdit extends ModalComponent
{
    public $data;
    public $model;
    public $data_id;

    public function createProperty($name, $value)
    {
        $this->{$name} = $value;
    }

    public function mount($id, $data)
    {
        $this->data_id = $id;
        $this->data = $data['fields'];
        $this->model = app($data['model'])->find($id);

        foreach ($this->data as $field) {
            $this->createProperty($field[0], $this->model->{$field[0]});
        }
    }

    public function submit()
    {

        $data = [];
        foreach ($this->data as $field) {
            $this->validate([
                $field[0] => "required"
            ]);
            $data += [$field[0] => $this->{$field[0]}];
        }

        $this->model->update($data);

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.component.utils.modal-edit');
    }
}
