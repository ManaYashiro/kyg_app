<?php

use App\Http\Controllers\AnketController;
use App\Http\Controllers\AppointmentListController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\ConfirmationItemController;
use App\Http\Controllers\ReservationListController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TopController::class, 'index'])->name('top');

Route::get('/support/categories', function () {
    return view('workCategories');
})->name('categories');

Route::get('/support/stores', function () {
    return view('storeIntroduction');
})->name('stores');

Route::get('/support/guide', function () {
    return view('userGuide');
})->name('guide');

Route::get('/support/faq', function () {
    return view('frequentlyAskedQuestions');
})->name('faq');

Route::middleware('auth', 'verified')->group(function () {
    Route::middleware([AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('reservationList', ReservationListController::class)->only(['index', 'edit', 'update']);
        Route::get('reservationList/download-reservations-as-csv', [ReservationListController::class, 'downloadReservationsAsCSV'])->name('reservationList.downloadReservationsAsCSV');
        Route::post('reservationList/cancel-reservations', [ReservationListController::class, 'cancelReservations']);

        Route::resource('userList', UserController::class)->except(['show']);
        // multiple delete users
        Route::post('userList/delete-users', [UserController::class, 'deleteUsers'])->name('userList.deleteUsers');
        Route::get('userList/download-users-as-csv', [UserController::class, 'downloadUsersAsCSV'])->name('userList.downloadUsersAsCSV');
        Route::resource('stores', StoreController::class);
        Route::resource('ankets', AnketController::class);
        Route::resource('notificationSetting', NotificationController::class);
    });

    Route::middleware([UserMiddleware::class])->group(function () {
        Route::get('/mypage', function () {
            return view('mypage');
        })->name('mypage');

        Route::resource('/mypage/reservations', AppointmentListController::class);
        Route::post('/mypage/reservations/confirm', [AppointmentListController::class, 'confirm'])->name('appointmentList.confirm');
        Route::post('/reservations/update', [AppointmentListController::class, 'update'])->name('appointmentDetails.store');
        Route::delete('/reservations/{id}', [AppointmentListController::class, 'destroy'])->name('appointmentList.destroy');

        Route::get('/appointment-confirmation', function () {
            return view('appointmentConfirmation');
        })->name('appointment.confirmation');

        Route::get('/account-termination-request', function () {
            return view('accountTerminationRequest');
        })->name('account.termination');
    });

    // 予約確認
    Route::get('/reservation/confirmation', [ConfirmationItemController::class, 'confirm'])->name('appointments.confirm'); //最終内容確認(ログイン修正保留)
    // 予約登録
    Route::post('/reservation/store', [ConfirmationItemController::class, 'store'])->name('confirmationItems.store');

    Route::get('/change-account-information', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/change-account-information', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/change-account-information', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 予約データをセッションに保存する
Route::post('/reservation/process', [ConfirmationItemController::class, 'process'])->name('confirmationItems.process');
// 予約申込フォーム
Route::get('/reservation/entry/{process_id}', [ConfirmationItemController::class, 'entry'])->name('confirmationItems.entry');

Route::get('appointmentList/events', [AppointmentListController::class, 'events'])->withoutMiddleware('auth')->name('appointmentList.events');
Route::get('appointmentList/go-to/unreserved', [AppointmentListController::class, 'gotoNearestUnreserved'])->withoutMiddleware('auth')->name('appointmentList.goto.NearestUnreserved');

require __DIR__ . '/auth.php';
