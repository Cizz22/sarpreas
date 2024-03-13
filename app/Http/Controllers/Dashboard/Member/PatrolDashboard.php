<?php

namespace App\Http\Controllers\Dashboard\Member;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Report;
use App\Models\SessionSchedule;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatrolDashboard extends Controller
{
    public function index(Request $request)
    {
        $patrol_schedule = auth()->user()->squad->getTodaySession('patroli');

        $location = Location::query()
            ->leftjoin('reports', function ($join) use ($patrol_schedule) {
                $join->on('reports.location_id', '=', 'locations.id')
                    ->where('reports.session_schedule_id', '=', $patrol_schedule->id);
            })->select('locations.*', 'reports.id as report_id', 'reports.situation as situation', 'reports.additional_information as additional_information');

        $checkpoints = $location->get();
        $nullReport = $location->whereNull('reports.id')->first();

        if (!$nullReport) {
            $patrol_schedule->update([
                'status' => 'Sudah Dilakukan',
                'end_time' => Carbon::now()->format('H:i:s')
            ]);
        }

        $default_position = 0;

        if (session('position')) {
            $default_position = session('position') + 1;
        }

        return view('dashboard.member.patrol', [
            'patrol_schedule' => $patrol_schedule,
            'checkpoints' => $checkpoints,
            'default_position' => $default_position
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

    //     return redirect()->route('dashboard.member.patrol');
    // }

    public function checkpoint(Request $request)
    {
        Report::create([
            'session_schedule_id' => $request->patrol_schedule_id,
            'location_id' => $request->location_id,
            'situation' => $request->status,
            'latitude' => $request->lat,
            'longitude' => $request->long,
            'additional_information' => $request->keterangan
        ]);

        return redirect()->route('dashboard.member.patrol')->with('position', $request->position);
    }
}
