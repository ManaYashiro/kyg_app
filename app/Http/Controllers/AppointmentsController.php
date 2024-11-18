<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;

class  AppointmentsController extends Controller
{
    public function index(Request $request)
    {
        $appointment = Appointments::all();
        return view('appointments', compact('appointment'));
    }

    public function confirm(Request $request)
    {
        // userからIDを受け取る
        $userId = Auth::user()->id;

        // バリデーション初期設定
        $rules = [
            'reservation_datetime' => 'nullable|date',
            'vehicle_name.0' => 'required|string|max:255',
            'registration_number.0' => 'required|string|max:255',
            'vehicle_type.0' => 'required|string|max:255',
            'inspection_due_date.0' => 'required|date',
            'additional_services.0' => 'nullable',
            'past_service_history' => 'required|string',
            'message' => 'nullable|string|max:255',
        ];

        foreach ($request->vehicle_name as $index => $value) {
            // 車両名が入力されている場合、他の項目を必須にする
            if ($value !== null && $value !== '') {
                $rules["vehicle_name.$index"] = 'required|string|max:255';
                $rules["registration_number.$index"] = 'required|string|max:255';
                $rules["vehicle_type.$index"] = 'required|string|max:255';
                $rules["inspection_due_date.$index"] = 'required|date';
            }
        }

        // バリデーションエラーメッセージ
        $errorMessages = [
            'past_service_history.required' => '過去利用履歴は必須項目です。',
            'vehicle_name.*.required' => '車両名は必須項目です。',
            'registration_number.*.required' => '登録番号は必須項目です。',
            'vehicle_type.*.required' => '車両タイプは必須項目です。',
            'inspection_due_date.*.required' => '車検期限を選択してください。',
        ];

        // バリデーションを実行
        $validatedData = $request->validate($rules, $errorMessages);

        $sortNumber = 1; // ソート番号

        // 予約日時を取得
        $reservationDatetime = $validatedData['reservation_datetime'];

        // 予約日付を 'YYYYMMDD' の形式に変換
        $date = \Carbon\Carbon::parse($reservationDatetime)->format('Ymd');

        // 同じ日に既に存在する予約番号のカウント
        $existingCount = Appointments::whereDate('reservation_datetime', $reservationDatetime)->count();

        // 新しい予約番号を作成（例: 20231112001）
        $appointmentNumber = $date . str_pad($existingCount + 1, 3, '0', STR_PAD_LEFT);

        $vehicles = [];
        // 各車両のデータをループして保存
        foreach ($validatedData['vehicle_name'] as $index => $vehicleName) {
            // データを配列に格納
            $data = [
                'user_id' => $userId,
                'appoint_number' => $appointmentNumber,
                'sort_number' => $sortNumber,
                'reservation_datetime' => $reservationDatetime,
                'vehicle_name' => $vehicleName,
                'registration_number' => $validatedData['registration_number'][$index],
                'vehicle_type' => $validatedData['vehicle_type'][$index],
                'inspection_due_date' => $validatedData['inspection_due_date'][$index],
                'additional_services' => isset($validatedData['additional_services'][$index])
                    ? implode(",", $validatedData['additional_services'][$index])
                    : null,
                'past_service_history' => $validatedData['past_service_history'],
                'message' => $validatedData['message'],
            ];
            $vehicles[] = $data;

            $sortNumber++; // ソート番号をインクリメント
        }

        // 確認画面に必要なデータを渡す
        return view('appointmentsConfirm', compact('vehicles'));
    }

    public function store(Request $request)
    {
        // 送信された車両情報を配列で取得
        $vehicleNames = $request->input('vehicle_name');
        $registrationNumbers = $request->input('registration_number');
        $vehicleTypes = $request->input('vehicle_type');
        $inspectionDueDates = $request->input('inspection_due_date');
        $additionalServices = $request->input('additional_services');
        $reservationDatetime = $request->input('reservation_datetime');
        $pastServiceHistory = $request->input('past_service_history');
        $message = $request->input('message');

        // 車両ごとにAppointmentsテーブルに保存
        foreach ($vehicleNames as $index => $vehicleName) {
            $appointment = new Appointments();
            $appointment->user_id = Auth::user()->id;  // ユーザーID
            $appointment->appoint_number = $request->input('appoint_number');  // 予約番号
            $appointment->reservation_datetime = $reservationDatetime;
            $appointment->vehicle_name = $vehicleName;
            $appointment->registration_number = $registrationNumbers[$index];
            $appointment->vehicle_type = $vehicleTypes[$index];
            $appointment->inspection_due_date = $inspectionDueDates[$index];
            $appointment->additional_services = $additionalServices[$index] ?? null;
            $appointment->past_service_history = $pastServiceHistory;
            $appointment->message = $message;
            $appointment->sort_number = $index + 1;  // 車両の並び順

            // 保存
            $appointment->save();
        }
        return redirect()->route('appointments.index')->with('success', '予約が確定しました');
    }
}
