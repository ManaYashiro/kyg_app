<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Appointments;

class  AppointmentsController extends Controller
{
    public function index(Request $request)
    {
        $appointment = Appointments::all();
        return view('appointments',compact('appointment'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $validatedData = $request->validate([
            'reservation_datetime' => 'nullable|date',
            'vehicle_name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255',
            'vehicle_type' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255',
            'inspection_due_date' => 'required|date',
            'additional_services' => 'array|nullable',
            'past_service_history' => 'required|string',
            'message' => 'nullable|string|max:255',
        ]);

        // 仮でuser_idを設定 (例: 1 を仮のIDとして使用)
        $validatedData['user_id'] = 1;
        // sort_numberを手動で設定 (仮に1を設定)
        $validatedData['sort_number'] = 1;
        //カンマ区切りで文字列に変換
        if(isset($request->additional_services)){
            $validatedData['additional_services'] = implode(",",$request->additional_services);
        }
        // 新しいレコードを作成
        Appointments::create($validatedData);
        return redirect()->route('appointments.index')->with('success', '車検予約が保存されました。');
    }

}
