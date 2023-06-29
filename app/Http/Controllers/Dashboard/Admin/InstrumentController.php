<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.instrument.index');
    }
}
