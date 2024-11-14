<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AppointmentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('top');
});

Route::middleware('auth', 'verified')->group(function () {

    // old dashboard
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::middleware([AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('userList', UserController::class);
        Route::resource('notificationSetting', NotificationController::class);
    });

    Route::get('/mypage', function () {
        return view('mypage');
    })->name('mypage');

    Route::get('/reservation-history', function () {
        return view('reservationHistory');
    })->name('reservation.history');

    Route::get('/reservation-confirmation', function () {
        return view('reservationConfirmation');
    })->name('reservation.confirmation');

    // Route::get('/change-account-information', function () {
    //     return view('changeAccountInformation');
    // })->name('account.information');

    Route::get('/account-termination-request', function () {
        return view('accountTerminationRequest');
    })->name('account.termination');

    Route::get('/userGuide', function () {
        return view('userGuide');
    })->name('userGuide');
    Route::get('/appointments', [AppointmentsController::class, 'index'])->name('appointments.index');
    Route::post('/appointments', [AppointmentsController::class, 'store'])->name('appointments.store');

    Route::get('/change-account-information', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/change-account-information', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/change-account-information', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
