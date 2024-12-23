<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task_Category;
use App\Models\Task_Reservation;

class TopController extends Controller
{
    public function index(Request $request)
    {
        return view('Top');
    }

    public function getTaskData()
    {
        $task_category = Task_Category::all(); // 作業カテゴリ
        $task_reservation = Task_Reservation::all(); // 予約作業

        return response()->json([
            'task_category' => $task_category,
            'task_reservation' => $task_reservation,
        ]);
    }
}
