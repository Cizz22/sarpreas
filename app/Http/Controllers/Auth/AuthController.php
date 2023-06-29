<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
    }

    public function passcode()
    {
        return view('auth.passcode');
    }

    public function pickLogin()
    {
        return view('auth.pick-login');
    }

    public function passcode_login(Request $request)
    {
        $this->validate($request, [
            'passcode' => 'required|max:6'
        ]);


        $user = User::whereHas('passcode', function ($q) {
            $q->where('passcode', request()->passcode);
        })->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->back()->withErrors(['passcode' => 'Invalid passcode']);
        }
    }
}
