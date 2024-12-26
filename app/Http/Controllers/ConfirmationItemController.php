<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\UserVehicle;
use App\Models\Anket;
use Illuminate\Support\Facades\Auth;

class  ConfirmationItemController extends Controller
{
    public function index(Request $request)
    {
        $appointment = Appointments::all();
        return view('confirmationItems', compact('appointment'));
    }

    public function confirm(Request $request)
    {
        // userからIDを受け取る
        $user = Auth::user();
        //バリデーション
        $rules = [
            'user_vehicle_id' => 'required|string',
            'additional_services' => 'nullable|array',
            'inspection_due_date' => 'required|date',
            'past_service_history' => 'required|string',
        ];
        // バリデーションエラーメッセージ
        $errorMessages = [
            'user_vehicle_id' => '【車両選択】複数お車をご登録されている方は、何台目に登録されているお車か選択してください。を選択してください。',
            'inspection_due_date' => '車検満期日をご入力ください。を入力してください。',
            'past_service_history' => '今回ご予約いただく店舗・作業は、過去にご利用がございますか？を選択してください。',
        ];

        // バリデーションの実行
        $validatedData = $request->validate($rules, $errorMessages);

        // ユーザーに関連付けられた車両データを取得
        $userVehicle = UserVehicle::where('user_id', $user->id)->first();

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
        $car1_class = getCarClass($userVehicle->car1_class);
        $car2_class = getCarClass($userVehicle->car2_class);
        $car3_class = getCarClass($userVehicle->car3_class);

        //2022-1-1から2022/1/1に変換
        $birthday = $user->birthday;
        $formattedBirthday = date('Y/m/d', strtotime($birthday));

        // 新しい予約番号を動的に生成
        // reservation_numberはAppointments modelに移動する

        //最終内容確認へ渡すために代入
        $finalcheck = [
            'user_vehicle_id' => $validatedData['user_vehicle_id'],
            'additional_services' => $validatedData['additional_services'] ?? [],  // 空の場合は空の配列
            'inspection_due_date' => $validatedData['inspection_due_date'],
            'past_service_history' => $validatedData['past_service_history'],
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
                'questionnaire' => $anketnames,
                'manager' => $user->manager,
                'department' => $user->department,
            ],
            'vehicles' => [
                'car1_name' => $userVehicle->car1_name,
                'car1_katashiki' => $userVehicle->car1_katashiki,
                'car1_number' => $userVehicle->car1_number,
                'car1_class' => $car1_class,
                'car2_name' => $userVehicle->car2_name,
                'car2_katashiki' => $userVehicle->car2_katashiki,
                'car2_number' => $userVehicle->car2_number,
                'car2_class' => $car2_class,
                'car3_name' => $userVehicle->car3_name,
                'car3_katashiki' => $userVehicle->car3_katashiki,
                'car3_number' => $userVehicle->car3_number,
                'car3_class' => $car3_class,
            ],
        ];
        session([
            'user_vehicle_id' => $request->input('user_vehicle_id'),
            'additional_services' => $request->input('additional_services'),
            'inspection_due_date' => $request->input('inspection_due_date'),
            'past_service_history' => $request->input('past_service_history'),
        ]);

        // 確認画面に必要なデータを渡す
        return view('appointmentsConfirm', compact('finalcheck', 'anketnames', 'anket', 'appointmentNumber'));
    }

    public function store(Request $request)
    {
        // 新しい予約番号を受け取る
        $appointmentNumber = $request->input('appointmentNumber');
        // 新しい予約を保存
        $appointment = new Appointments();
        $appointment->user_id = Auth::id(); //ユーザーID
        $appointment->reservation_number = $appointmentNumber; //予約番号
        $appointment->reservation_datetime = $request->input('inspection_due_date'); //予約日時
        $appointment->customer_name = $request->input('user'); //顧客名
        $appointment->store = $request->input('user'); //ご希望の店舗(仮)
        $appointment->taskcategory = $request->input('user'); //作業カテゴリ(仮)
        $appointment->reservationtask = $request->input('user'); //予約する作業(仮)
        $appointment->user_vehicle_id = $request->input('user_vehicle_id'); //車両台数
        $appointment->additional_services = $request->input('additional_services'); //追加整備
        $appointment->inspection_due_date = $request->input('inspection_due_date'); //	車検満了日
        $appointment->past_service_history = $request->input('past_service_history'); //過去の利用履歴
        $appointment->requirement = $request->input('requirement'); //予約ご要望
        $appointment->save();

        return redirect()->route('top');
    }
}
