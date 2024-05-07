<?php

namespace App\Http\Controllers\Dashboard\Squad;

use App\Http\Controllers\Controller;
use App\Models\SessionSchedule;
use App\Models\SessionScheduleMember;
use Carbon\Carbon;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $squad = auth()->user()->squad;
        $interval_schedule = $squad->getTodayIntervalScheduleId();

        if(!$interval_schedule){
            Auth::logout();
            return redirect()->route('passcode')->withErrors(['passcode' => 'Hanya diperbolehkan login di jam shift']);
        }

        return view('dashboard.squad.index', compact('squad', 'interval_schedule'));
    }

    public function start(Request $request)
    {

        $this->validate($request, [
            'type' => 'required|in:patroli,gedung,pos',
            'members' => 'required|array',
        ]);

        // check Session already exist
        $session = SessionSchedule::where('interval_schedule_id', $request->interval_schedule)
            ->where('type', $request->type)
            ->first();

        if ($session) {
            return redirect()->route('dashboard.squad.index')->with('error', 'Sesi sudah ada');
        }

        $sessionSchedule = SessionSchedule::create([
            'interval_schedule_id' => $request->interval_schedule,
            'start_time' => Carbon::now()->format('H:i:s'),
            'status' => 'Sedang Dilakukan',
            'type' => $request->type,
        ]);

        foreach ($request->members as $member) {
            $member = SessionScheduleMember::create([
                'member_id' => $member,
                'session_schedule_id' => $sessionSchedule->id,
            ]);
        }

        if($request->type == 'patroli'){
            return redirect()->route('dashboard.member.patrol');
        }else{
            return redirect()->route('dashboard.member.posgedung', ['type' => $request->type]);
        }
    }
}
