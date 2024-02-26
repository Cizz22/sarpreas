<?php

namespace Database\Seeders;

use App\Models\Instrument;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstrumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instrument = [
            "BERPAKAIAN (BERSEPATU + SERAGAM)",
            "TUGAS POKOK (SEBELUM ISTIRAHAT)",
            "TUGAS KELOMPOK"
        ];

        $indoor = Unit::where('name', 'Kebersihan Indoor')->first()->id;
        $outdoor = Unit::where('name', 'Kebersihan Outdoor')->first()->id;

        foreach ($instrument as $instrumen) {
            Instrument::create([
                'instrument' => $instrumen,
                'unit_id' => $indoor
            ]);

            Instrument::create([
                'instrument' => $instrumen,
                'unit_id' => $outdoor
            ]);
        }


    }
}
