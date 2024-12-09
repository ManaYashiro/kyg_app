<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\UserVehicles;
use App\Models\Anket;
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

        //バリデーション
        $rules = [
            'vehicle' => 'required|string',
            'additional_services' => 'nullable|array',
            'inspection_due_date' => ['required', function ($value) {
                // 日付形式の検証
                // 1. 西暦形式 (YYYY/MM/DD) の正規表現チェック
                // 2. 令和形式 (令和X年X月X日) の正規表現チェック
                if (
                    // 西暦形式チェック (YYYY/MM/DD)
                    !preg_match('/^\d{4}\/\d{2}\/\d{2}$/', $value) &&
                    !preg_match('/^(令和)(\d{1,2})年(\d{1,2})月(\d{1,2})日$/', $value) // 令和形式チェック (令和X年X月X日)
                ) {
                    return;
                }
            }],
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

        // ユーザーに関連付けられた車両データを取得
        $userVehicles = UserVehicles::where('user_id', $user->id)->first();

        // 性別値を取得
        $genderValue = $user->gender->value;
        $gender = ($genderValue === 0) ? '男' : (($genderValue === 1) ? '女' : null); //値から文字変換

        // メルマガ値を取得
        $newsletter = $user->gender->value;
        $is_receive_newsletter = ($newsletter === 0) ? '配信を希望しない' : (($newsletter === 1) ? '配信を希望する' : null); //値から文字変換

        //アンケート値を取得
        $anket = $user->questionnaire;
        $anketnames = Anket::whereIn('id', $anket)->pluck('name', 'id'); //IDから名前取得

        //車種区分
        function getCarClass($car_class)
        {
            switch ($car_class) {
                case 1:
                    return '軽自動車';
                case 2:
                    return '小型乗用車(車両重量～1.0t)';
                case 3:
                    return '中型乗用車(車両重量～1.5t)';
                case 4:
                    return '大型乗用車(車両重量～2.0t)';
                case 5:
                    return '大型乗用車(車両重量～2.5t)';
                case 6:
                    return '上記以外';
                default:
                    return null;
            }
        }

        // 車の分類を取得
        $car1_class = getCarClass($userVehicles->car1_class);
        $car2_class = getCarClass($userVehicles->car2_class);
        $car3_class = getCarClass($userVehicles->car3_class);

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
                'is_receive_newsletter' => $is_receive_newsletter,
                'questionnaire' => $anketnames,
                'manager' => $user->manager,
                'department' => $user->department,
            ],
            'vehicles' => [
                'car1_name' => $userVehicles->car1_name,
                'car1_katashiki' => $userVehicles->car1_katashiki,
                'car1_number' => $userVehicles->car1_number,
                'car1_class' => $car1_class,
                'car2_name' => $userVehicles->car2_name,
                'car2_katashiki' => $userVehicles->car2_katashiki,
                'car2_number' => $userVehicles->car2_number,
                'car2_class' => $car2_class,
                'car3_name' => $userVehicles->car3_name,
                'car3_katashiki' => $userVehicles->car3_katashiki,
                'car3_number' => $userVehicles->car3_number,
                'car3_class' => $car3_class,
            ],
        ];

        // 確認画面に必要なデータを渡す
        return view('appointmentsConfirm', compact('finalcheck', 'anketnames', 'anket'));
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
