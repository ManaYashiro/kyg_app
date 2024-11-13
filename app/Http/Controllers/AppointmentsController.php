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
        //車両名を判定のために受け取る
        $vehicle_names = $request->input('vehicle_name',[]);

        // バリデーションルール初期化
        $validationRules = [
            'reservation_datetime' => 'nullable|date',
            'past_service_history' => 'required|string',
            'message' => 'nullable|string|max:255',
        ];
        // 車両数に応じてバリデーションルールを追加
        foreach ($vehicle_names as $index => $vehicle_name) {
            if (!empty($vehicle_name)) {
                // 車両名が入力されている場合にバリデーションルールを追加
                $validationRules["vehicle_name.$index"] = 'required|string|max:255';
                $validationRules["registration_number.$index"] = 'required|string|max:255';
                $validationRules["vehicle_type.$index"] = 'required|string|max:255';
                $validationRules["license_plate.$index"] = 'required|string|max:255';
                $validationRules["inspection_due_date.$index"] = 'required|date';
                $validationRules["additional_services.$index"] = 'array|nullable';
            }
        }
        //バリデーションエラーメッセージ
        $validatedData = $request->validate(
            $validationRules,
            [
                'past_service_history.required' => '過去のサービス履歴は必須項目です。',
                'vehicle_name.*.required' => '車両名は必須項目です。',
                'registration_number.*.required' => '登録番号は必須項目です。',
                'vehicle_type.*.required' => '車両タイプは必須項目です。',
                'license_plate.*.required' => 'ナンバープレートは必須項目です。',
                'inspection_due_date.*.required' => '車検期限を選択してください。',
            ]
        );

        // バリデーションを実行
        $validatedData = $request->validate($validationRules);

        $userId = 1; // 仮のユーザーID
        $sortNumber = 1; // ソート番号

        // 各車両のデータをループして保存
        foreach ($validatedData['vehicle_name'] as $index => $vehicleName) {
            $data = [
                'user_id' => $userId,
                'sort_number' => $sortNumber,
                'reservation_datetime' => $validatedData['reservation_datetime'],
                'vehicle_name' => $vehicleName,
                'registration_number' => $validatedData['registration_number'][$index],
                'vehicle_type' => $validatedData['vehicle_type'][$index],
                'license_plate' => $validatedData['license_plate'][$index],
                'inspection_due_date' => $validatedData['inspection_due_date'][$index],
                'additional_services' => isset($validatedData['additional_services'][$index])
                ? implode(",", $validatedData['additional_services'][$index])
                : null,
                'past_service_history' => $validatedData['past_service_history'],
                'message' => $validatedData['message'],
            ];
            // 新しいレコードを作成
            Appointments::create($data);
            $sortNumber++;
        }
        return redirect()->route('appointments.index')->with('success', '車検予約が保存されました。');
    }

}
