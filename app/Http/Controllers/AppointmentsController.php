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

        //1台目が入力されて、2台目が未入力の場合
        // if (isset($vehicle_names[0]) && (empty($vehicle_names[1]))) {
        //     // 1台目だけのバリデーション
        //     $validatedData = $request->validate([
        //         'reservation_datetime' => 'nullable|date',
        //         'vehicle_name.0' => 'required|string|max:255',
        //         'registration_number.0' => 'required|string|max:255',
        //         'vehicle_type.0' => 'required|string|max:255',
        //         'license_plate.0' => 'required|string|max:255',
        //         'inspection_due_date.0' => 'required|date',
        //         'additional_services.0' => 'array|nullable',
        //         'past_service_history' => 'required|string',
        //         'message' => 'nullable|string|max:255',
        //     ]);
        // } else {
        //     // 両方に対するバリデーション
        //     $validatedData = $request->validate([
        //         'reservation_datetime' => 'nullable|date',
        //         'vehicle_name.*' => 'required|string|max:255',
        //         'registration_number.*' => 'required|string|max:255',
        //         'vehicle_type.*' => 'required|string|max:255',
        //         'license_plate.*' => 'required|string|max:255',
        //         'inspection_due_date.*' => 'required|date',
        //         'additional_services.*' => 'array|nullable',
        //         'past_service_history' => 'required|string',
        //         'message' => 'nullable|string|max:255',
        //     ]);
        // }
        // バリデーションルール初期化
        $validationRules = [
            'reservation_datetime' => 'nullable|date',
            'past_service_history' => 'required|string',
            'message' => 'nullable|string|max:255',
        ];

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

        $validatedData = $request->validate($validationRules);

        $userId = 1; // 仮のユーザーID
        $sortNumber = 1; // 仮のソート番号

        // 各車両のデータをループして保存
        foreach ($validatedData['vehicle_name'] as $index => $vehicleName) {
            $data = [
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
                'user_id' => $userId,
                'sort_number' => $sortNumber,
            ];
            // 新しいレコードを作成
            Appointments::create($data);
        }
        return redirect()->route('appointments.index')->with('success', '車検予約が保存されました。');
    }

}
