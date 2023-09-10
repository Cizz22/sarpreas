<?php

namespace App\Http\Livewire\Member\Components\Patrol;

use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalAman extends ModalComponent
{
    public $location_id, $patrol_id, $keterangan, $lat, $long, $position;
    public function render()
    {
        return view('livewire.member.components.patrol.modal-aman');
    }

    public function mount($location_id, $patrol_id, $position)
    {

        $this->location_id = $location_id;
        $this->patrol_id = $patrol_id;
        $this->position = $position;
    }

    public function submit()
    {
        Report::create([
            'unit_id' => Auth::user()->member->unit_id,
            'session_schedule_id' => $this->patrol_id,
            'location_id' => $this->location_id,
            'situation' => 'aman',
            'latitude' => $this->lat,
            'longitude' => $this->long,
            'additional_information' => $this->keterangan
        ]);

        $this->dispatchBrowserEvent('closeModalPatrol', ['position' => $this->position]);
        $this->closeModal();
    }
}
