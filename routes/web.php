<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\Admin\CoordinatorController;
use App\Http\Controllers\Dashboard\Admin\DashboardController;
use App\Http\Controllers\Dashboard\Admin\InstrumentController;
use App\Http\Controllers\Dashboard\Admin\MemberController;
use App\Http\Controllers\Dashboard\Admin\UnitController;
use App\Http\Controllers\Dashboard\Coordinator\DashboardController as CoordinatorDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Auth Route
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'pickLogin'])->name('pick-login');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('passcode', [AuthController::class, 'passcode'])->name('passcode');
    Route::post('passcode', [AuthController::class, 'passcode_login'])->name('passcode-login');
});




//Dashboard Route
Route::prefix('dashboard')->middleware('auth')->name('dashboard.')->group(function () {
    Route::get('/', function () {
        if (Auth::user()) {
            if (Auth::user()->roles == 'admin') {
                return redirect(route('dashboard.admin.index'));
            } else if (Auth::user()->roles == 'coordinator') {
                return redirect(route('dashboard.coordinator.index'));
            } else {
                return redirect(route('/'));
            }
        }
    })->name('index');

    //Admin
    Route::prefix('admin')->middleware('usertype:admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::post('/report', [DashboardController::class, 'report'])->name('report');
        Route::get('/unit', [UnitController::class, 'index'])->name('unit');
        Route::get('/coordinator', [CoordinatorController::class, 'index'])->name('coordinator');
        Route::get('/member', [MemberController::class, 'index'])->name('member');
        Route::get('/instrument', [InstrumentController::class, 'index'])->name('instrument');
    });
    //Coordinator
    Route::prefix('coordinator')->middleware('usertype:coordinator')->name('coordinator.')->group(function () {
        Route::get('/', [CoordinatorDashboardController::class, 'index'])->name('index');
    });
});
