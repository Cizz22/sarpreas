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
        $location = Location::query()
            ->leftjoin('reports', function ($join) use ($request) {
                $join->on('reports.location_id', '=', 'locations.id')
                    ->where('reports.session_schedule_id', '=', $request->patrol_schedule->first()->id);
            })->select('locations.*', 'reports.id as report_id');

        $checkpoints = $location->get();
        $nullReport = $location->whereNull('reports.id')->first();

        if (!$nullReport) {
            $request->patrol_schedule->update([
                'status' => 'Sudah Dilakukan',
                'end_time' => Carbon::now()->format('H:i:s')
            ]);
        }

        if (session('position')) {
            $default_position = session('position') + 1;
        }


        return view('dashboard.member.patrol', [
            'patrol_schedule' => $request->patrol_schedule,
            'checkpoints' => $checkpoints,
            'default_position' => $default_position ?? 0
        ]);
    }

    public function start_patroli(Request $request)
    {
        $patrol = SessionSchedule::find($request->patrol_schedule_id);

        $patrol->update([
            'status' => 'Sedang Dilakukan',
            'start_time' => Carbon::now()->format('H:i:s')
        ]);

        $patrol->save();

        return redirect()->route('dashboard.member.patrol');
    }

    public function checkpoint(Request $request)
    {
        Report::create([
            'unit_id' => Auth::user()->member->unit_id,
            'session_schedule_id' => $request->patrol_schedule_id,
            'location_id' => $request->location_id,
            'situation' => $request->status,
            'latitude' => $request->lat,
            'longitude' => $request->long,
            'additional_information' => $request->keterangan
        ]);

        session()->flash('position', $request->position);

        return redirect()->route('dashboard.member.patrol');
    }
}
