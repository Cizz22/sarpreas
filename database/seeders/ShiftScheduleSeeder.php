<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $shift = [
            'Pagi',
            'Siang',
            'Malam',
            'Libur'
        ];

        $start_time = [
            '07:00',
            '15:00',
            '23:00',
            null
        ];

        $end_time = [
            '14:59',
            '22:59',
            '06:59',
            null
        ];

        for ($j = 0; $j < 4; $j++) {
            \App\Models\ShiftSchedule::create([
                'type' => $shift[$j],
                'start_time' => $start_time[$j],
                'end_time' => $end_time[$j]
            ]);
        }
    }
}
