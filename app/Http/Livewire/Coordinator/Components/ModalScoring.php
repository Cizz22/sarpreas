<?php

namespace App\Http\Livewire\Coordinator\Components;

use App\Models\Member;
use App\Models\PresensiMember;
use App\Models\ScoreMember;
use App\Models\Subunit;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ModalScoring extends ModalComponent
{
    public $member_id, $instruments, $subunit_id, $presensi;

    public function render()
    {
        return view('livewire.coordinator.components.modal-scoring');
    }

    public function mount($member_id, $subunit_id)
    {
        $this->member_id = $member_id;
        $this->subunit_id = $subunit_id;

        $unit = Subunit::find($subunit_id)->unit;

        $this->instruments = $unit->instruments;


        //initialize variable
        foreach ($this->instruments as $i => $instrument) {
            $this->createProperty('instrument' . $i, "");
        }
    }

    public function submit()
    {
        $validate = [];
        foreach ($this->instruments as $i => $value) {
            $validate['instrument' . $i] = 'required';
        }
        $validate['presensi'] = 'required';
        $this->validate($validate);

        $member = Member::find($this->member_id);

        if ($member->scoreMember()->whereDate('created_at', today())->exists()) {
            return $this->addError('member_id', 'Member sudah dinilai');
        }

        $presensi = PresensiMember::create([
            'member_id' => $this->member_id,
            'subunits_id' => $this->subunit_id,
            'coordinator_id' => auth()->user()->member->id,
            'status' => $this->presensi,
            'tanggal_presensi' => now(),
        ]);

        $score = ScoreMember::create([
            'member_id' => $this->member_id,
            'subunit_id' => $this->subunit_id,
            'coordinator_id' => auth()->user()->member->id,
            'presensi_id' => $presensi->id,
            'tanggal_penilaian' => now(),
        ]);



        foreach ($this->instruments as $k => $instrument) {
            $score->scoreDetail()->create([
                'instrument_id' => $instrument->id,
                'score' => $this->{'instrument' . $k},
            ]);
        }

        redirect()->route('dashboard.coordinator.index');
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }

    public function createProperty($name, $value)
    {
        $this->{$name} = $value;
    }
}
