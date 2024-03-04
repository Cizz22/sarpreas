<?php

namespace App\Http\Controllers\Dashboard\Squad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $squad = auth()->user()->squad;

        return view('dashboard.squad.index', compact('squad'));
    }
}
