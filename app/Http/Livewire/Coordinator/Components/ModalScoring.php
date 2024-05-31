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
        // Validate presensi first
        $this->validate(['presensi' => 'required']);
        foreach ($this->instruments as $i => $value) {
            if ($this->presensi != 'Hadir') {
                $this->{'instrument' . $i} = 0;
            } else {
                if(!$this->{'instrument' . $i}) {
                    return $this->addError('instrument' . $i, 'Nilai harus diisi');
                }
                $validate['instrument' . $i] = 'required';
            }
        }

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

        $sum_score = 0;

        foreach ($this->instruments as $k => $instrument) {
            $score->scoreDetail()->create([
                'instrument_id' => $instrument->id,
                'score' => $this->{'instrument' . $k},
            ]);

            $sum_score += $this->{'instrument' . $k};
        }

        $total_score = floor(($sum_score / (25 * count($this->instruments))) * 100);

        $score->total_score = $total_score;
        $score->save();

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
