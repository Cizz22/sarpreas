<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\Admin\CarbookingController;
use App\Http\Controllers\Dashboard\Admin\CarController;
use App\Http\Controllers\Dashboard\Admin\CoordinatorController;
use App\Http\Controllers\Dashboard\Admin\DashboardController;
use App\Http\Controllers\Dashboard\Admin\InstrumentController;
use App\Http\Controllers\Dashboard\Admin\MemberController;
use App\Http\Controllers\Dashboard\Admin\UnitController;
use App\Http\Controllers\Dashboard\Coordinator\DashboardController as CoordinatorDashboardController;
use App\Http\Controllers\Guest\CarBooking\FormBookingController;
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

Route::get('test_import', [App\Http\Controllers\TestImport::class, 'index']);


//Auth Route
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'pickLogin'])->name('pick-login');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('passcode', [AuthController::class, 'passcode'])->name('passcode');
    Route::post('passcode', [AuthController::class, 'passcode_login'])->name('passcode-login');
});

Route::prefix('peminjaman-kendaraan')->name('peminjaman.')->group(function () {
    Route::get('form', [App\Http\Controllers\Guest\CarBooking\FormBookingController::class, 'index'])->name('form');
    Route::post('form/submit', [App\Http\Controllers\Guest\CarBooking\FormBookingController::class, 'submit'])->name('form.submit');
    Route::get('form/success', [App\Http\Controllers\Guest\CarBooking\FormBookingController::class, 'success'])->name('form.success');
    Route::get('kendaraan', [App\Http\Controllers\Guest\CarBooking\ListCarController::class, 'index'])->name('list-kendaraan');
    Route::get('pinjam', [App\Http\Controllers\Guest\CarBooking\FormReturnBorrowController::class, 'index'])->name('form-borrow-return');
    Route::post('pinjam/submit', [App\Http\Controllers\Guest\CarBooking\FormReturnBorrowController::class, 'submit'])->name('form-borrow.submit');
});



//Dashboard Route
Route::prefix('dashboard')->middleware('auth')->name('dashboard.')->group(function () {
    Route::get('/', function () {
        if (Auth::user()) {
            if (Auth::user()->roles == 'admin') {
                return redirect(route('dashboard.admin.index'));
            } else if (Auth::user()->roles == 'coordinator') {
                return redirect(route('dashboard.coordinator.index'));
            } else if (Auth::user()->roles == 'squad') {
                return redirect(route('dashboard.squad.index'));
            } else {
                Auth::logout();
                return redirect()->route('passcode');
            }
        }
    })->name('index');

    //Admin
    Route::prefix('admin')->middleware('usertype:admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::post('/report', [DashboardController::class, 'report'])->name('report');
        Route::post('/report/skk', [DashboardController::class, 'reportSKK'])->name('reportSKK');
        Route::get('/unit', [UnitController::class, 'index'])->name('unit');
        Route::get('/coordinator', [CoordinatorController::class, 'index'])->name('coordinator');
        Route::get('/member', [MemberController::class, 'index'])->name('member');
        Route::get('/instrument', [InstrumentController::class, 'index'])->name('instrument');
        Route::get('/carbooking', [CarbookingController::class, 'index'])->name('carbooking');
        Route::get('/car', [CarController::class, 'index'])->name('car');
    });
    //Coordinator
    Route::prefix('coordinator')->middleware('usertype:coordinator')->name('coordinator.')->group(function () {
        Route::get('/', [CoordinatorDashboardController::class, 'index'])->name('index');
    });

    //Member
    Route::prefix('squad')->middleware('usertype:squad')->name('squad.')->group(function () {
        Route::get('/', [App\Http\Controllers\Dashboard\Squad\DashboardController::class, 'index'])->name('index');
        Route::post('/patrol', [App\Http\Controllers\Dashboard\Squad\DashboardController::class, 'start'])->name('start.patrol');
    });

    Route::prefix('member')->name('member.')->group(function() {
        Route::get('/patrol', [App\Http\Controllers\Dashboard\Member\PatrolDashboard::class, 'index'])->name('patrol');
        Route::post('/patrol/start', [App\Http\Controllers\Dashboard\Member\PatrolDashboard::class, 'start_patroli'])->name('patrol.start');
        Route::post('/patrol/checkpoint', [App\Http\Controllers\Dashboard\Member\PatrolDashboard::class, 'checkpoint'])->name('patrol.checkpoint');
        Route::get('/posgedung', [App\Http\Controllers\Dashboard\Member\PosgedungDashboard::class, 'index'])->name('posgedung');
        Route::post('/posgedung/checkpoint', [App\Http\Controllers\Dashboard\Member\PosgedungDashboard::class, 'checkpoint'])->name('posgedung.checkpoint');
    });
});
