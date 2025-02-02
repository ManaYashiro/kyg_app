<?php

use App\Helpers\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("inspection")->group(function () {
    // 1. 予約作成（車検・点検）
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

    // 3. 予約キャンセル（車検・点検）
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

    // 5. カレンダー取得（車検・点検）
    Route::get("/calendar", function (Request $request) {

        // OK
        return response()->json([
            'availability' => testCalendarData(),
        ], 200);

        // Bad Request
        return response()->json([
            "message" => "エラー理由（入力パラメータ不正など）"
        ], 400);

        // Internal Server Error
        return response()->json([
            "message" => "エラー理由（内部エラーなど）"
        ], 500);
    });
});

Route::prefix("supplies")->group(function () {
    // 2. 予約作成（用品_Web）
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

    // 4. 予約キャンセル（用品_Web）
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

    // 6. カレンダー取得（用品_Web）
    Route::get("/calendar", function (Request $request) {

        // OK
        return response()->json([
            'availability' => testCalendarData(),
        ], 200);

        // Bad Request
        return response()->json([
            "message" => "エラー理由（入力パラメータ不正など）"
        ], 400);

        // Internal Server Error
        return response()->json([
            "message" => "エラー理由（内部エラーなど）"
        ], 500);
    });
});

Route::prefix("reservations")->group(function () {
    // 9. 予約キャンセル
    Route::delete("/{reservationNo}", function (Request $request, $reservationNo) {

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

    // 8. 予約ステータス変更
    Route::post("/accept", function (Request $request) {

        // OK
        return response()->json([], 201);

        // Bad Request
        return response()->json([
            "message" => "エラー理由（入力パラメータ不正など）"
        ], 400);

        // Internal Server Error
        return response()->json([
            "message" => "エラー理由（内部エラーなど）"
        ], 500);
    });

    // 10. 予約情報変更
    Route::post("/update", function (Request $request) {

        // OK
        return response()->json([], 201);

        // Bad Request
        return response()->json([
            "message" => "エラー理由（入力パラメータ不正など）"
        ], 400);

        // Internal Server Error
        return response()->json([
            "message" => "エラー理由（内部エラーなど）"
        ], 500);
    });
});


function testCalendarData(): array
{
    return  [
        [
            "date" => "20250107",
            "time_slots" => [
                ["time_slot" => "09:00-09:30", "status" => 1],
                ["time_slot" => "09:30-10:00", "status" => 1],
                ["time_slot" => "10:00-10:30", "status" => 0],
                ["time_slot" => "10:30-11:00", "status" => 0],
                ["time_slot" => "11:00-11:30", "status" => 1],
                ["time_slot" => "11:30-12:00", "status" => 1],
                ["time_slot" => "12:00-12:30", "status" => -1],
                ["time_slot" => "12:30-13:00", "status" => -1],
                ["time_slot" => "13:00-13:30", "status" => 0],
                ["time_slot" => "13:30-14:00", "status" => 0],
                ["time_slot" => "14:00-14:30", "status" => 0],
                ["time_slot" => "14:30-15:00", "status" => 0],
                ["time_slot" => "15:00-15:30", "status" => 0],
                ["time_slot" => "15:30-16:00", "status" => 0],
                ["time_slot" => "16:00-16:30", "status" => 0],
                ["time_slot" => "16:30-17:00", "status" => 0],
                ["time_slot" => "17:00-17:30", "status" => 0],
                ["time_slot" => "17:30-18:30", "status" => 0]
            ]
        ],
        [
            "date" => "20250108",
            "time_slots" => [
                ["time_slot" => "09:00-09:30", "status" => 1],
                ["time_slot" => "09:30-10:00", "status" => 1],
                ["time_slot" => "10:00-10:30", "status" => 0],
                ["time_slot" => "10:30-11:00", "status" => 0],
                ["time_slot" => "11:00-11:30", "status" => 1],
                ["time_slot" => "11:30-12:00", "status" => 1],
                ["time_slot" => "12:00-12:30", "status" => -1],
                ["time_slot" => "12:30-13:00", "status" => -1],
                ["time_slot" => "13:00-13:30", "status" => 0],
                ["time_slot" => "13:30-14:00", "status" => 0],
                ["time_slot" => "14:00-14:30", "status" => 0],
                ["time_slot" => "14:30-15:00", "status" => 0],
                ["time_slot" => "15:00-15:30", "status" => 0],
                ["time_slot" => "15:30-16:00", "status" => 0],
                ["time_slot" => "16:00-16:30", "status" => 0],
                ["time_slot" => "16:30-17:00", "status" => 0],
                ["time_slot" => "17:00-17:30", "status" => 0],
                ["time_slot" => "17:30-18:30", "status" => 0]
            ]
        ],
        [
            "date" => "20250109",
            "time_slots" => [
                ["time_slot" => "09:00-09:30", "status" => 1],
                ["time_slot" => "09:30-10:00", "status" => 1],
                ["time_slot" => "10:00-10:30", "status" => 0],
                ["time_slot" => "10:30-11:00", "status" => 0],
                ["time_slot" => "11:00-11:30", "status" => 1],
                ["time_slot" => "11:30-12:00", "status" => 1],
                ["time_slot" => "12:00-12:30", "status" => -1],
                ["time_slot" => "12:30-13:00", "status" => -1],
                ["time_slot" => "13:00-13:30", "status" => 0],
                ["time_slot" => "13:30-14:00", "status" => 0],
                ["time_slot" => "14:00-14:30", "status" => 0],
                ["time_slot" => "14:30-15:00", "status" => 0],
                ["time_slot" => "15:00-15:30", "status" => 0],
                ["time_slot" => "15:30-16:00", "status" => 0],
                ["time_slot" => "16:00-16:30", "status" => 0],
                ["time_slot" => "16:30-17:00", "status" => 0],
                ["time_slot" => "17:00-17:30", "status" => 0],
                ["time_slot" => "17:30-18:30", "status" => 0]
            ]
        ],
        [
            "date" => "20250110",
            "time_slots" => [
                ["time_slot" => "09:00-09:30", "status" => 1],
                ["time_slot" => "09:30-10:00", "status" => 1],
                ["time_slot" => "10:00-10:30", "status" => 0],
                ["time_slot" => "10:30-11:00", "status" => 0],
                ["time_slot" => "11:00-11:30", "status" => 1],
                ["time_slot" => "11:30-12:00", "status" => 1],
                ["time_slot" => "12:00-12:30", "status" => -1],
                ["time_slot" => "12:30-13:00", "status" => -1],
                ["time_slot" => "13:00-13:30", "status" => 0],
                ["time_slot" => "13:30-14:00", "status" => 0],
                ["time_slot" => "14:00-14:30", "status" => 0],
                ["time_slot" => "14:30-15:00", "status" => 0],
                ["time_slot" => "15:00-15:30", "status" => 0],
                ["time_slot" => "15:30-16:00", "status" => 0],
                ["time_slot" => "16:00-16:30", "status" => 0],
                ["time_slot" => "16:30-17:00", "status" => 0],
                ["time_slot" => "17:00-17:30", "status" => 0],
                ["time_slot" => "17:30-18:30", "status" => 0]
            ]
        ],
        [
            "date" => "20250111",
            "time_slots" => [
                ["time_slot" => "09:00-09:30", "status" => 1],
                ["time_slot" => "09:30-10:00", "status" => 1],
                ["time_slot" => "10:00-10:30", "status" => 0],
                ["time_slot" => "10:30-11:00", "status" => 0],
                ["time_slot" => "11:00-11:30", "status" => 1],
                ["time_slot" => "11:30-12:00", "status" => 1],
                ["time_slot" => "12:00-12:30", "status" => -1],
                ["time_slot" => "12:30-13:00", "status" => -1],
                ["time_slot" => "13:00-13:30", "status" => 0],
                ["time_slot" => "13:30-14:00", "status" => 0],
                ["time_slot" => "14:00-14:30", "status" => 0],
                ["time_slot" => "14:30-15:00", "status" => 0],
                ["time_slot" => "15:00-15:30", "status" => 0],
                ["time_slot" => "15:30-16:00", "status" => 0],
                ["time_slot" => "16:00-16:30", "status" => 0],
                ["time_slot" => "16:30-17:00", "status" => 0],
                ["time_slot" => "17:00-17:30", "status" => 0],
                ["time_slot" => "17:30-18:30", "status" => 0]
            ]
        ],
        [
            "date" => "20250112",
            "time_slots" => [
                ["time_slot" => "09:00-09:30", "status" => 1],
                ["time_slot" => "09:30-10:00", "status" => 1],
                ["time_slot" => "10:00-10:30", "status" => 0],
                ["time_slot" => "10:30-11:00", "status" => 0],
                ["time_slot" => "11:00-11:30", "status" => 1],
                ["time_slot" => "11:30-12:00", "status" => 1],
                ["time_slot" => "12:00-12:30", "status" => -1],
                ["time_slot" => "12:30-13:00", "status" => -1],
                ["time_slot" => "13:00-13:30", "status" => 0],
                ["time_slot" => "13:30-14:00", "status" => 0],
                ["time_slot" => "14:00-14:30", "status" => 0],
                ["time_slot" => "14:30-15:00", "status" => 0],
                ["time_slot" => "15:00-15:30", "status" => 0],
                ["time_slot" => "15:30-16:00", "status" => 0],
                ["time_slot" => "16:00-16:30", "status" => 0],
                ["time_slot" => "16:30-17:00", "status" => 0],
                ["time_slot" => "17:00-17:30", "status" => 0],
                ["time_slot" => "17:30-18:30", "status" => 0]
            ]
        ],
        [
            "date" => "20250113",
            "time_slots" => [
                ["time_slot" => "09:00-09:30", "status" => 1],
                ["time_slot" => "09:30-10:00", "status" => 1],
                ["time_slot" => "10:00-10:30", "status" => 0],
                ["time_slot" => "10:30-11:00", "status" => 0],
                ["time_slot" => "11:00-11:30", "status" => 1],
                ["time_slot" => "11:30-12:00", "status" => 1],
                ["time_slot" => "12:00-12:30", "status" => -1],
                ["time_slot" => "12:30-13:00", "status" => -1],
                ["time_slot" => "13:00-13:30", "status" => 0],
                ["time_slot" => "13:30-14:00", "status" => 0],
                ["time_slot" => "14:00-14:30", "status" => 0],
                ["time_slot" => "14:30-15:00", "status" => 0],
                ["time_slot" => "15:00-15:30", "status" => 0],
                ["time_slot" => "15:30-16:00", "status" => 0],
                ["time_slot" => "16:00-16:30", "status" => 0],
                ["time_slot" => "16:30-17:00", "status" => 0],
                ["time_slot" => "17:00-17:30", "status" => 0],
                ["time_slot" => "17:30-18:30", "status" => 0]
            ]
        ]
    ];
}
