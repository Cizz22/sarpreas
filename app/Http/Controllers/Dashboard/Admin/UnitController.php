<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        return view('dashboard.admin.unit.index');
    }
}
