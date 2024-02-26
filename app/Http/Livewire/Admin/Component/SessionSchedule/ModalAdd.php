<?php

namespace App\Http\Livewire\Admin\Component\SessionSchedule;

use App\Models\SessionSchedule;
use App\Models\Unit;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalAdd extends ModalComponent
{
    public $members, $unit_id, $shift, $date, $unit_name;

    public $member_1, $member_2;

    public function render()
    {
        return view('livewire.admin.component.session-schedule.modal-add');
    }

    public function mount($unit_id)
    {
        $this->unit_id = $unit_id;
        $this->unit_name = Unit::find($unit_id)->name;
        $this->members = User::where('roles', 'member')->whereRelation('member', 'unit_id', $this->unit_id)->get();
    }

    public function submit()
    {
        $this->validate([
            'member_1' => 'required',
            'member_2' => 'required',
            'shift' => 'required',
            'date' => 'required'
        ]);

        if ($this->member_1 == $this->member_2) {
            $this->addError('member_2', 'Member 2 tidak boleh sama dengan Member 1');
            return;
        }

        $isSessionAlreadyExist = SessionSchedule::where('date', $this->date)
            ->where('shift', $this->shift)
            ->where('member_1_id', $this->member_1)
            ->orWhere('member_2_id', $this->member_2)
            ->first();

        if ($isSessionAlreadyExist) {
            $this->addError('date', 'Jadwal dengan anggota pertama atau anggota kedua yang anda masukkan sudah ada');
            return;
        }

        SessionSchedule::create([
            'member_1_id' => $this->member_1,
            'member_2_id' => $this->member_2,
            'shift' => $this->shift,
            'date' => $this->date,
            'unit_id' => $this->unit_id
        ]);

        $this->closeModalWithEvents([
            'pg:eventRefresh-default',
        ]);
    }
}
