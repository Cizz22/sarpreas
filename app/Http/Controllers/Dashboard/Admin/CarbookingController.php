<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarbookingController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.carbooking.index');
    }
}
