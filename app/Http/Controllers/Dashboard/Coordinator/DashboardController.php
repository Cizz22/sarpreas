<?php

namespace App\Http\Controllers\Dashboard\Coordinator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $subunit = Auth::user()->member->coordinator;


        return view('dashboard.coordinator.index', compact('subunit'));
    }


}
