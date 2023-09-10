<?php

namespace App\Http\Controllers\Dashboard\Member;

use App\Http\Controllers\Controller;
use App\Models\SessionSchedule;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatrolDashboard extends Controller
{
    public function index()
    {
        $patrol_schedule = Auth::user()->member->session_schedule()->where('date', today());

        if (!$patrol_schedule->get()) {
            Auth::logout();
            return redirect()->route('pick-login');
        }
        //Check if user login in right shift time

        //Pagi => 06:00 - 12:00
        //Siang => 12:00 - 18:00
        //Malam => 18:00 - 00:00

        $current_time = Carbon::now();
        if ($current_time->between(Carbon::parse('06:00'), Carbon::parse('12:00'))) {
            $shift = 'Pagi';
        } elseif ($current_time->between(Carbon::parse('12:00'), Carbon::parse('18:00'))) {
            $shift = 'Siang';
        } elseif ($current_time->between(Carbon::parse('18:00'), Carbon::parse('23:59'))) {
            $shift = 'Malam';
        } else {
            $shift = 'Invalid Shift'; // Handle cases outside of your specified ranges
        }

        if ($patrol_schedule->where('shift', $shift)->first()) {
            return view('dashboard.member.patrol', [
                'patrol_schedule' => $patrol_schedule->first(),
            ]);
        } else {
            Auth::logout();
            return redirect()->route('pick-login');
        }
    }

    public function start_patroli(Request $request)
    {
        $patrol = SessionSchedule::find($request->patrol_schedule_id);

        $patrol->update([
            'status' => 'Sedang Dilakukan',
            // 'start_time' => Carbon::now()->format('H:i:s')
        ]);

        $patrol->save();

        return redirect()->route('dashboard.member.patrol');
    }
}
