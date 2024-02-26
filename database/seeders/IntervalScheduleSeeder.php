<?php

namespace Database\Seeders;

use App\Models\IntervalSchedule;
use App\Models\ShiftSchedule;
use App\Models\Squad;
use App\Traits\IntervalTrait;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IntervalScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    use IntervalTrait;

    public function run(): void
    {
        //Get total days in month until this month
        $now = Carbon::now();
        $firstOfJanuary = Carbon::createFromDate($now->year, 1, 1);

        $daysCurrentMonth = Carbon::createFromDate($now->year, $now->month, $now->endOfMonth()->day);

        // Calculate the difference in days
        $totalDays = $firstOfJanuary->diffInDays($daysCurrentMonth);

        //Exclude squads with name 'Merah' and 'Putih'
        $squads = ['A', 'B', 'C', 'D', 'Merah', 'Putih'];

        foreach ($squads as $squadName) {
            $squadPattern = Squad::intervalPattern($squadName);
            $date = Carbon::create(2024, 1, 1);;

            $squadId = Squad::where('name', $squadName)->first()->id;
            $pattern = $this->generateInterval($squadPattern, $totalDays);

            for ($i = 0; $i < $totalDays; $i++) {
                $shift = ShiftSchedule::where('type', $pattern[$i])->first();

                IntervalSchedule::create([
                    'date' => $date,
                    'shift_schedule_id' => $shift->id,
                    'squad_id' => $squadId
                ]);

                $date->addDay();
            }
        }
    }
}
