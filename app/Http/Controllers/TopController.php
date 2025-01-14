<?php

namespace App\Http\Controllers;

use App\Models\ReservationTask;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index(Request $request)
    {
        $reservationTasks = ReservationTask::all();

        return view('top', compact('reservationTasks'));
    }
}
