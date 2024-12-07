<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;

class  ConfirmationItemController extends Controller
{
    public function index(Request $request)
    {
        $appointment = Appointments::all();
        return view('confirmationitems', compact('appointment'));
    }

    public function confirm(Request $request)
    {
        // userからIDを受け取る
        $user = Auth::user();
        //性別変換
        $gender = ($user->gender == 1) ? '男' : (($user->gender == 2) ? '女' : null);

        //バリデーション
        $rules = [
            'vehicle' => 'required|string',
            'additional_services' => 'nullable|array',
            'inspection_due_date' => 'required|date',
            'past_service_history' => 'required|string',
        ];

        // バリデーションエラーメッセージ
        $errorMessages = [
            'vehicle' => '【車両選択】複数お車をご登録されている方は、何台目に登録されているお車か選択してください。を選択してください。',
            'inspection_due_date' => '車検満期日をご入力ください。を入力してください。',
            'past_service_history' => '今回ご予約いただく店舗・作業は、過去にご利用がございますか？を選択してください。',
        ];

        // バリデーションの実行
        $validatedData = $request->validate($rules, $errorMessages);

        //最終内容確認へ渡すために代入
        $finalcheck = [
            'vehicle' => $validatedData['vehicle'],
            'additional_services' => $validatedData['additional_services'] ?? [],  // 空の場合は空の配列
            'inspection_due_date' => $validatedData['inspection_due_date'],
            'past_service_history' => $validatedData['past_service_history'],
            'user' => [
                'name' => $user->name,
                'name_furigana' => $user->name_furigana,
                'birthday' => $user->birthday,
                'gender' => $gender,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'call_time' => $user->call_time,
                'zipcode' => $user->zipcode,
                'prefecture' => $user->prefecture,
                'address1' => $user->address1,
                'address2' => $user->address2,
            ],
        ];

        // 確認画面に必要なデータを渡す
        return view('appointmentsConfirm', compact('finalcheck'));
    }

    // public function store(Request $request)
    // {
    // // 送信された車両情報を配列で取得
    // $vehicleNames = $request->input('vehicle_name');
    // $registrationNumbers = $request->input('registration_number');
    // $vehicleTypes = $request->input('vehicle_type');
    // $inspectionDueDates = $request->input('inspection_due_date');
    // $additionalServices = $request->input('additional_services');
    // $reservationDatetime = $request->input('reservation_datetime');
    // $pastServiceHistory = $request->input('past_service_history');
    // $message = $request->input('message');

    // // 車両ごとにAppointmentsテーブルに保存
    // foreach ($vehicleNames as $index => $vehicleName) {
    //     $appointment = new Appointments();
    //     $appointment->user_id = Auth::user()->id;  // ユーザーID
    //     $appointment->appoint_number = $request->input('appoint_number');  // 予約番号
    //     $appointment->reservation_datetime = $reservationDatetime;
    //     $appointment->vehicle_name = $vehicleName;
    //     $appointment->registration_number = $registrationNumbers[$index];
    //     $appointment->vehicle_type = $vehicleTypes[$index];
    //     $appointment->inspection_due_date = $inspectionDueDates[$index];
    //     $appointment->additional_services = $additionalServices[$index] ?? null;
    //     $appointment->past_service_history = $pastServiceHistory;
    //     $appointment->message = $message;
    //     $appointment->sort_number = $index + 1;  // 車両の並び順

    //     // 保存
    //     $appointment->save();
    // }
    // return redirect()->route('appointments.index')->with('success', '予約が確定しました');
    // }
}
