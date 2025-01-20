<?php

use App\Http\Controllers\ConfirmationItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function (Request $request) {
    return response()->json([
        'success' => true,
        'message' => 'TEST',
    ], 200);
});
