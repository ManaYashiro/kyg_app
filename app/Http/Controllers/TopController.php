<?php

namespace App\Http\Controllers;

use App\Helpers\ReservationSession;
use App\Models\ReservationTask;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index(Request $request)
    {
        $reservationTasks = ReservationTask::all();
        $process_id = ReservationSession::getProcessId();
        $processData = ReservationSession::get($process_id);

        return view('top', compact('reservationTasks', 'processData'));
    }
}
