<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("inspection")->group(function () {
    Route::post("/reservations", function (Request $request) {

        // OK
        return response()->json([
            "timestamp" => "20241225130099",
        ], 200);

        // Bad Request
        return response()->json([
            "message" => "エラー理由（入力パラメータ不正など）"
        ], 400);

        // Conflict
        return response()->json([
            "message" => "エラー理由(予約重複など）"
        ], 409);

        // Internal Server Error
        return response()->json([
            "message" => "エラー理由（内部エラーなど）"
        ], 500);
    });

    Route::delete("/reservations/{reservationNo}", function (Request $request, $reservationNo) {
        // OK
        return response()->json([
            "timestamp" => "20241225130099",
        ], 200);

        // Bad Request
        return response()->json([
            "message" => "エラー理由（入力パラメータ不正など）"
        ], 400);

        // Internal Server Error
        return response()->json([
            "message" => "エラー理由（内部エラーなど）予約データが見つからないなど含む"
        ], 500);
    });
});

Route::prefix("supplies")->group(function () {
    Route::post("/reservations", function (Request $request) {

        // OK
        return response()->json([
            "reservationNo" => "Y32021202412010001",
            "timestamp" => "20241225130099",
        ], 200);

        // Bad Request
        return response()->json([
            "message" => "エラー理由（入力パラメータ不正など）"
        ], 400);

        // Conflict
        return response()->json([
            "message" => "エラー理由(予約重複など）"
        ], 409);

        // Internal Server Error
        return response()->json([
            "message" => "エラー理由（内部エラーなど）"
        ], 500);
    });

    Route::delete("/reservations/{reservationNo}", function (Request $request, $reservationNo) {
        // OK
        return response()->json([
            "timestamp" => "20241225130099",
        ], 200);

        // Bad Request
        return response()->json([
            "message" => "エラー理由（入力パラメータ不正など）"
        ], 400);

        // Internal Server Error
        return response()->json([
            "message" => "エラー理由（内部エラーなど）予約データが見つからないなど含む"
        ], 500);
    });
});
