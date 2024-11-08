<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('top');
});

Route::get('/reservation-history', function () {
    return view('reservationHistory');
})->name('reservation.history');

Route::get('/reservation-confirmation', function () {
    return view('reservationConfirmation');
})->name('reservation.confirmation');

Route::get('/change-account-information', function () {
    return view('changeAccountInformation');
})->name('account.information');

Route::get('/account-termination-request', function () {
    return view('accountTerminationRequest');
})->name('account.termination');

Route::get('/mypage', function () {
    return view('mypage');
})->middleware(['auth', 'verified'])->name('mypage');

Route::middleware('auth', 'verified')->group(function () {
    Route::middleware('auth', 'verified')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
