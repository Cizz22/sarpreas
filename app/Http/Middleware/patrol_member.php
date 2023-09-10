<?php

namespace App\Http\Middleware;

use App\Models\Location;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class patrol_member
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the current date and time
        $currentDateTime = now();

        // Determine the date to check for patrol schedule
        $dateToCheck = $currentDateTime->format('Y-m-d');

        $patrol_schedule = Auth::user()->member->session_schedule()
            ->where(function ($query) use ($dateToCheck) {
                $query->where('date', $dateToCheck)
                    ->orWhere('date', now()->subDay()->format('Y-m-d'));
            });

        // $patrol_schedule = Auth::user()->member->session_schedule()->where('date', today());
        if (!$patrol_schedule->exists()) {
            Auth::logout();
            return redirect()->route('pick-login');
        }

        $current_time = Carbon::now();

        //Check if user login in right shift time

        //Pagi => 06:00 - 12:00
        //Siang => 12:00 - 18:00
        //Malam => 18:00 - 05.00(next day)

        if ($current_time->between(Carbon::parse('06:00'), Carbon::parse('11:59'))) {
            $shift = 'Pagi';
        } elseif ($current_time->between(Carbon::parse('12:00'), Carbon::parse('18:00'))) {
            $shift = 'Siang';
        } else {
            $shift = 'Malam';
        }

        if (!$patrol_schedule->where('shift', $shift)->first()) {
            Auth::logout();
            return redirect()->route('pick-login');
        }

        $request->merge([
            'patrol_schedule' => $patrol_schedule->first(),
        ]);

        return $next($request);




        // if ($patrol_schedule->exists()) {
        //     //GET current time
        //     $current_time = Carbon::now();

        //     //Check if user login in right shift time

        //     //Pagi => 06:00 - 12:00
        //     //Siang => 12:00 - 18:00
        //     //Malam => 18:00 - 05.00(next day)

        //     if ($current_time->between(Carbon::parse('06:00'), Carbon::parse('11:59'))) {
        //         $shift = 'Pagi';
        //     } elseif ($current_time->between(Carbon::parse('12:00'), Carbon::parse('18:00'))) {
        //         $shift = 'Siang';
        //     } else {
        //         $shift = 'Malam';
        //     }

        //     if ($patrol_schedule->where('shift', $shift)->first()) {
        //         // $location = Location::query()
        //         //     ->leftjoin('reports', function ($join) use ($patrol_schedule) {
        //         //         $join->on('reports.location_id', '=', 'locations.id')
        //         //             ->where('reports.session_schedule_id', '=', $patrol_schedule->first()->id);
        //         //     })->select('locations.*', 'reports.id as report_id');

        //         // $checkpoints = $location->get();
        //         // $nullReport = $location->whereNull('reports.id')->first();

        //         // if (!$nullReport) {
        //         //     $patrol_schedule->update([
        //         //         'status' => 'Sudah Dilakukan',
        //         //         // 'end_time' => Carbon::now()->format('H:i:s')
        //         //     ]);
        //         // }

        //         // if (session('position')) {
        //         //     $default_position = session('position') + 1;
        //         // }

        //         $request->merge([
        //             'patrol_schedule' => $patrol_schedule->first(),
        //             'checkpoints' => $checkpoints,
        //             'default_position' => $default_position ?? 0
        //         ]);
        //         return $next($request);
        //     } else {
        //         Auth::logout();
        //         return redirect()->route('pick-login');
        //     }
        // } else {
        //     Auth::logout();
        //     return redirect()->route('pick-login');
        // }
    }
}
