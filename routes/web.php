<?php

use App\Http\Controllers\AnketController;
use App\Http\Controllers\AppointmentListController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\ReservationManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('top');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::middleware([AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('reservationmanagement', ReservationManagementController::class);
        Route::resource('userList', UserController::class);
        Route::resource('stores', StoreController::class);
        Route::resource('ankets', AnketController::class);
        Route::resource('notificationSetting', NotificationController::class);
    });

    Route::get('/mypage', function () {
        return view('mypage');
    })->name('mypage');

    Route::resource('appointmentList', AppointmentListController::class);

    Route::get('/appointment-confirmation', function () {
        return view('appointmentConfirmation');
    })->name('appointment.confirmation');

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
