<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class  AppointmentListController extends Controller
{
    /**
     * Display the appointments list with optional role filtering.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $currentDateTime = now(); // 現在の日時を取得

        // フィルタとソート
        $appointments = Appointments::where('user_id', Auth::user()->id);

        // 予約番号の並び替え
        if ($request->filled('sort_number')) {
            $appointments->orderBy('reservation_number', $request->sort_number); // 'desc' または 'asc'
        }

        $appointments = $appointments->get();

        $filteredGroupedAppointments = $appointments->filter(function ($appointment) {
            return Carbon::parse($appointment->reservation_datetime)
                ->setTimezone('Asia/Tokyo')
                ->gte(Carbon::now('Asia/Tokyo'));
        });

        // 予約日時のフォーマット変更（時間部分のみ）
        $filteredGroupedAppointments = $filteredGroupedAppointments->map(function ($appointment) {
            // フォーマットして新しいプロパティを追加
            $appointment->reservation_datetime = Carbon::parse($appointment->reservation_datetime)
                ->setTimezone('Asia/Tokyo')
                ->format('Y-m-d H:i');  // '2024-12-20 10:00' の形式
            return $appointment;
        });

        // ビューにデータを渡す
        return view('appointmentHistory', compact('appointments', 'filteredGroupedAppointments'));
    }

    /**
     * 予約詳細画面
     */

    public function edit($id)
    {
        // Find the appointment by ID
        $appointment = Appointments::where('user_id', Auth::user()->id)->where('id', $id)->first();

        // reservation_datetimeを秒数を除いてフォーマット変更
        $appointment->reservation_datetime = Carbon::parse($appointment->reservation_datetime)->format('Y/m/d H:i');

        // 予約詳細ビューにデータを渡す
        return view('appointmentDetails', compact('appointment'));
    }

    /**
     * 予約確認
     */

    public function confirm(Request $request)
    {
        //バリデーション
        $rules = [
            'inspection_due_date' => 'required|date',
        ];
        // バリデーションエラーメッセージ
        $errorMessages = [
            'inspection_due_date' => '車検満期日をご入力ください。を入力してください。',
        ];

        // バリデーションの実行
        $validatedData = $request->validate($rules, $errorMessages);

        $appointment = $request->all();

        session([
            'inspection_due_date' => $request->input('inspection_due_date'),
        ]);

        // 確認画面に必要なデータを渡す
        return view('appointmentDetailsConfirm', compact('appointment'));
    }

    /**
     * 予約確定
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        // 指定されたIDのユーザーを取得
        $appointment = Appointments::where('appointments.id', $id)->first();
        $appointment->update($request->all());

        // 成功メッセージを表示してリストにリダイレクト
        return redirect()->route('appointmentList.index');
    }

    /**
     * 予約削除
     */
    public function destroy($id)
    {
        // 指定されたIDのユーザーを取得
        $appointment = Appointments::findOrFail($id);
        //論理削除
        $appointment->delete();
    }
}
