<?php

namespace App\Http\Controllers;

use App\Helpers\Log;
use App\Models\Appointments;
use App\Models\UserVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\ReservationTask;
use Illuminate\Support\Str;

class  ConfirmationItemController extends Controller
{

    // process (トップ画面からのデータをentryに渡す)
    public function process(Request $request)
    {
        $processData = $request->all();
        $process_id = Str::random(10);
        Session::put($process_id, $processData);

        return response()->json([
            'process_id' => $process_id,
        ]);
    }

    // entry
    public function index(Request $request, $process_id)
    {
        $processData = Session::get($process_id);
        Session::put('current_process_data', $processData);
        $appointment = Appointments::all();
        return view('confirmationItems', compact('appointment'));
    }

    public function confirm(Request $request)
    {
        $processData = Session::get('current_process_data');

        // userからIDを受け取る
        $user = Auth::user() ?? null;

        //バリデーション
        $rules = [
            'user_vehicle_id' => 'required|string',
            'additional_services' => 'nullable|array',
            'inspection_due_date' => 'required|date_format:Y/m/d',
            'past_service_history' => 'required|string',
        ];
        // バリデーションエラーメッセージ
        $errorMessages = [
            'user_vehicle_id' => '【車両選択】複数お車をご登録されている方は、何台目に登録されているお車か選択してください。を選択してください。',
            'inspection_due_date' => '車検満了日は、正しい日付ではありません。',
            'past_service_history' => '今回ご予約いただく店舗・作業は、過去にご利用がございますか？を選択してください。',
        ];

        // バリデーションの実行
        $validatedData = $request->validate($rules, $errorMessages);

        // 性別値を取得
        $genderValue = $user->gender->value;
        $gender = ($genderValue === 0) ? '男' : (($genderValue === 1) ? '女' : null); //値から文字変換

        // メルマガ値を取得
        $newsletter = $user->gender->value;
        $is_receive_newsletter = ($newsletter === 0) ? '配信を希望しない' : (($newsletter === 1) ? '配信を希望する' : null); //値から文字変換

        //2022-1-1から2022/1/1に変換
        $birthday = $user->birthday;
        $formattedBirthday = date('Y/m/d', strtotime($birthday));

        // 新しい予約番号を動的に生成
        // reservation_numberはAppointments modelに移動する

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

        // ユーザーに関連付けられた車両データを取得
        $userVehicle = UserVehicle::where('user_id', $user->id)->get();
        //車両情報を格納するための配列
        $vehicles = [];
        if ($userVehicle) {
            foreach ($userVehicle as $vehicle) {
                // 車両データが空でない場合のみ追加
                if (!empty($vehicle->car_name) || !empty($vehicle->car_katashiki) || !empty($vehicle->car_number) || !empty($vehicle->car_class)) {
                    $vehicles[] = [
                        'car_name' => $vehicle->car_name,
                        'car_katashiki' => $vehicle->car_katashiki,
                        'car_number' => $vehicle->car_number,
                        'car_class' => getCarClass($vehicle->car_class),
                    ];
                }
            }
        }

        //reservation_task_idから主キーを取得
        $reservationtask = ReservationTask::find($processData['reservation_task_id']);
        $reservation_name = $reservationtask ? $reservationtask->reservation_name : null;

        //最終内容確認へ渡すために代入
        $finalcheck = [
            'user_vehicle_id' => $validatedData['user_vehicle_id'],
            'additional_services' => $validatedData['additional_services'] ?? [],  // 空の場合は空の配列
            'inspection_due_date' => $validatedData['inspection_due_date'],
            'past_service_history' => $validatedData['past_service_history'],
            //顧客
            'user' => [
                'name' => $user->name,
                'name_furigana' => $user->name_furigana,
                'birthday' => $formattedBirthday,
                'gender' => $gender,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'call_time' => $user->call_time,
                'zipcode' => $user->zipcode,
                'prefecture' => $user->prefecture,
                'address1' => $user->address1,
                'address2' => $user->address2,
                'is_receive_newsletter' => $is_receive_newsletter,
                'questionnaire' => $user->questionnaire,
                'manager' => $user->manager,
                'department' => $user->department,
            ],
            //車両
            'vehicles' => $vehicles,
            //予約
            'reservation' => [
                'store' => $processData['store'] ?? null,
                'inspection_type' => $processData['inspection_type'] ?? null,
                'customer_type' => $processData['customer_type'] ?? null,
                'work_type' => $processData['work_type'] ?? null,
                'reservation_task_id' => $processData['reservation_task_id'] ?? null,
                'reservation_name' => $reservation_name,
                'appointmentDateTime' => $processData['appointmentDateTime'] ?? null,
            ]
        ];
        session([
            'user_vehicle_id' => $request->input('user_vehicle_id'),
            'additional_services' => $request->input('additional_services'),
            'inspection_due_date' => $request->input('inspection_due_date'),
            'past_service_history' => $request->input('past_service_history'),
        ]);

        // 確認画面に必要なデータを渡す
        return view('appointmentsConfirm', compact('finalcheck'));
    }

    public function store(Request $request)
    {
        // 新しい予約番号を受け取る
        $appointmentNumber = $request->input('appointmentNumber');

        // 新しい予約を保存
        $appointment = new Appointments();
        $appointment->user_id = Auth::id(); //ユーザーID
        $appointment->reservation_number = $appointmentNumber; //予約番号
        $appointment->reservation_datetime = $request->input('appointmentDateTime'); //予約日時
        $appointment->customer_name = $request->input('user'); //顧客名
        $appointment->store = $request->input('store'); //ご希望の店舗
        $appointment->inspection_type = $request->input('inspection_type'); //作業カテゴリ
        $appointment->work_type = $request->input('work_type'); //作業種別
        $appointment->reservation_task_id = $request->input('reservation_task_id'); //作業詳細
        $appointment->customer_type = $request->input('customer_type'); //個人/法人区分
        $appointment->user_vehicle_id = $request->input('user_vehicle_id'); //車両台数
        $appointment->additional_services = $request->input('additional_services'); //追加整備
        $appointment->inspection_due_date = $request->input('inspection_due_date'); //	車検満了日
        $appointment->past_service_history = $request->input('past_service_history'); //過去の利用履歴
        $appointment->remarks = $request->input('remarks'); //備考欄
        $appointment->save();

        return redirect()->route('top');
    }
}
