<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScoreMember;
use App\Models\Unit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * Display the dashboard.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $month = $this->getAllMonth();
        $year = $this->getAllYear();
        $unit = $this->getAllUnit();
        $userInputProvided = false;

        return view('dashboard.admin.index', compact('month', 'year', 'unit', 'userInputProvided'));
    }

    public function report(Request $request)
    {
        $this->validate(request(), [
            'month' => 'required',
            'year' => 'required',
            'unit' => 'required',
        ]);
        $month = $this->getAllMonth();
        $year = $this->getAllYear();
        $unit = $this->getAllUnit();

        $monthInput = $request->month;
        $yearInput = $request->year;
        $unitInput = $request->unit;

        $userInputProvided = true;

        return view('dashboard.admin.index', compact('monthInput', 'yearInput', 'unitInput', 'userInputProvided', 'month', 'year', 'unit'));
    }

    public function getAllMonth()
    {
        $month = ScoreMember::selectRaw('MONTH(created_at) as month')
            ->distinct()
            ->orderBy('month')
            ->get();

        return $month;
    }

    public function getAllYear()
    {
        $year = ScoreMember::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year')
            ->get();

        return $year;
    }

    public function getAllUnit()
    {
        $unit = Unit::select('id', 'name')
            ->get();

        return $unit;
    }
}
