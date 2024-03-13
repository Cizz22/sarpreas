<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScoreMember;
use App\Models\SessionSchedule;
use App\Models\Squad;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Display the dashboard.
     */
    public function index()
    {
        $month = $this->getAllMonth();
        $year = $this->getAllYear();
        $squad = $this->getAllSquad();
        $unit = Unit::all();

        //If redirect from report
        if (request()->has('month') && request()->has('year') && request()->has('unit')) {
            $monthInput = request()->month;
            $yearInput = request()->year;
            $unitInput = request()->unit;

            $userInputProvided = true;
            $userInputProvidedSKK = false;

            return view('dashboard.admin.index', compact('monthInput', 'yearInput', 'unitInput', 'userInputProvided', 'userInputProvidedSKK', 'month', 'year', 'unit', 'squad'));
        } else if (request()->has('date') && request()->has('shift') && request()->has('regu')) {
            $dateInput = request()->date;
            $shiftInput = request()->shift;
            $reguInput = request()->regu;

            $userInputProvidedSKK = true;
            $userInputProvided = false;

            return view('dashboard.admin.index', compact('dateInput', 'reguInput', 'shiftInput', 'unitInput', 'userInputProvided', 'userInputProvidedSKK', 'month', 'year', 'unit', 'squad'));
        }

        $userInputProvided = false;
        $userInputProvidedSKK = false;

        return view('dashboard.admin.index', compact('month', 'unit', 'year', 'squad', 'userInputProvided', 'userInputProvidedSKK'));
    }

    public function report(Request $request)
    {
        $this->validate(request(), [
            'month' => 'required',
            'year' => 'required',
            'unit' => 'required',
        ]);

        $monthInput = $request->month;
        $yearInput = $request->year;
        $unitInput = $request->unit;

        return redirect()->route('dashboard.admin.index', ['month' => $monthInput, 'year' => $yearInput, 'unit' => $unitInput]);

        // return view('dashboard.admin.index', compact('monthInput', 'yearInput', 'unitInput', 'userInputProvided', 'userInputProvidedSKK', 'month', 'year', 'unit'));
    }

    public function reportSKK(Request $request)
    {
        $this->validate(request(), [
            'unit' => 'required',
            'shift' => 'required',
            'date' => 'required',
        ]);

        $dateInput = Carbon::createFromFormat('Y-m-d', $request->date)->toDateString();
        $shiftInput = $request->shift;
        $unitInput = $request->unit;

        // $userInputProvidedSKK = true;
        // $userInputProvided = false;

        return redirect()->route('dashboard.admin.index', ['date' => $dateInput, 'shift' => $shiftInput, 'unit' => $unitInput]);

        // return view('dashboard.admin.index', compact('shiftInput', 'dateInput', 'unitInput', 'userInputProvided', 'userInputProvidedSKK', 'month', 'year', 'unit'));
    }





    public function getAllMonth()
    {
        //Chang eto postresql
        $month = ScoreMember::selectRaw('EXTRACT(MONTH FROM created_at) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return $month;
    }

    public function getAllYear()
    {
        $year = ScoreMember::selectRaw('EXTRACT(YEAR FROM created_at) as year')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        return $year;
    }

    public function getAllSquad()
    {
        $squad = Squad::all();

        return $squad;
    }
}
