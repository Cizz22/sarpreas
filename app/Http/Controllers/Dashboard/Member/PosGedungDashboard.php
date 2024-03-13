<?php

namespace App\Http\Controllers\Dashboard\Member;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\SessionSchedule;
use Composer\Semver\Interval;
use Illuminate\Support\Facades\Auth;

class PosGedungDashboard extends Controller
{

    public function index(Request $request)
    {
        // $checkpoints = $location->get();
        // $nullReport = $location->whereNull('reports.id')->first();

        // if (!$nullReport) {
        //     $request->patrol_schedule->update([
        //         'status' => 'Sudah Dilakukan',
        //         'end_time' => Carbon::now()->format('H:i:s')
        //     ]);
        // }
        $session_schedule = auth()->user()->squad->getTodaySession($request->type);
        $start_time = $session_schedule->intervalSchedule->shiftSchedule->start_time;
        $end_time = $session_schedule->intervalSchedule->shiftSchedule->end_time;

        $checkpoints = $this->makeIntervals($start_time, $end_time, $session_schedule->id);

        $default_position = 0;

        //check if any is_done in all checkpoint in checkpoints already true
        if (!$checkpoints->where('is_done', false)->count() > 0) {
            $session_schedule->update([
                'status' => 'Sudah Dilakukan',
                'end_time' => Carbon::now()->format('H:i:s')
            ]);
        }

        if (session('position')) {
            $default_position = session('position') + 1;
        }

        return view('dashboard.member.posgedung', [
            'patrol_schedule' => $session_schedule,
            'checkpoints' => $checkpoints,
            'default_position' => $default_position,
            'type' => $request->type
        ]);
    }

    // public function start_patroli(Request $request)
    // {
    //     $patrol = SessionSchedule::find($request->patrol_schedule_id);

    //     $patrol->update([
    //         'status' => 'Sedang Dilakukan',
    //         'start_time' => Carbon::now()->format('H:i:s')
    //     ]);

    //     $patrol->save();

    //     return redirect()->route('dashboard.member.posgedung');
    // }

    public function checkpoint(Request $request)
    {
        Report::create([
            'session_schedule_id' => $request->patrol_schedule_id,
            'interval_time' => $request->interval,
            'situation' => $request->status,
            'latitude' => $request->lat,
            'longitude' => $request->long,
            'additional_information' => $request->keterangan
        ]);

        return redirect()->route('dashboard.member.posgedung', ['type' => $request->type])->with('position', $request->position);
    }

    public function makeIntervals($start_time, $end_time, $session_schedule_id)
    {
        $intervals = collect([]);
        $intervalTime = 2 * 3600;

        $start_time = Carbon::parse($start_time);
        $end_time = Carbon::parse($end_time);

        //Make array of intervals every 2 hours between strt time and end time
        while ($start_time->lte($end_time)) {
            $start_time->addSeconds($intervalTime);

            $report = Report::where('session_schedule_id', $session_schedule_id)
                ->where('interval_time', $start_time->format('H:i'))
                ->first();

            $interval = [
                "name" => "Checkpoint " . $start_time->format('H:i'),
                "time" => $start_time->format('H:i'),
                "is_done" => $report ? true : false,
                "report" => [
                    "situation" => $report ? $report->situation : null,
                    "additional_information" => $report ? $report->additional_information : null
                ]
            ];

            $intervals->push($interval);
        }

        return $intervals;
    }
}
