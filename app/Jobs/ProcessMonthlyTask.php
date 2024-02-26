<?php

namespace App\Jobs;

use App\Models\IntervalSchedule;
use App\Models\ShiftSchedule;
use App\Models\Squad;
use App\Traits\IntervalTrait;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessMonthlyTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IntervalTrait;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //Get Current Date
        $currentDate = Carbon::now();

        //Get days in the month
        $daysInMonth = $currentDate->daysInMonth;

        //Get first date of the month

        $squads = Squad::all();

        foreach ($squads as $squad) {
            $squadPattern = Squad::intervalPattern($squad->name);
            $date = Carbon::create($currentDate->year, $currentDate->month, 1);
            $interval_length = $squad->intervalSchedule->count();

            $pattern = $this->generateInterval($squadPattern, $daysInMonth, $interval_length);

            for ($i = 0; $i < $daysInMonth; $i++) {
                $shift = ShiftSchedule::where('type', $pattern[$i])->first();

                IntervalSchedule::create([
                    'date' => $date,
                    'shift_schedule_id' => $shift->id,
                    'squad_id' => $squad->id
                ]);

                $date->addDay();
            }

        }
    }
}
