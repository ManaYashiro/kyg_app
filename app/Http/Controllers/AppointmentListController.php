<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
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
        $query = Appointments::where('user_id', Auth::user()->id);

        // 予約番号での検索
        if ($request->filled('appoint_number')) {
            $query->where('appoint_number', 'like', '%' . $request->appoint_number . '%');
        }

        // 日付の並び替え
        if ($request->filled('sort_date')) {
            $query->orderBy('reservation_datetime', $request->sort_date); // 'desc' または 'asc'
        } else {
            // デフォルトは新しい順
            $query->orderBy('reservation_datetime', 'desc');
        }

        // 予約番号でグループ化
        $appointments = $query->get()->groupBy('appoint_number');  // グループ化は最初に

        // 各グループ内で、現在日時以降の予約だけをフィルタリング
        $filteredGroupedAppointments = $appointments->map(function ($appointmentsGroup) use ($currentDateTime) {
            return $appointmentsGroup->filter(function ($appointment) use ($currentDateTime) {
                return $appointment->reservation_datetime >= $currentDateTime;
            });
        });

        \Log::info($filteredGroupedAppointments);
        // ビューにデータを渡す
        return view('appointmentHistory', compact('appointments', 'filteredGroupedAppointments'));
    }

    /**
     * 予約詳細画面
     */

    public function edit($appointNumber)
    {
        // 予約番号で予約情報を取得
        $appointment = Appointments::where('appoint_number', $appointNumber)->get();
        $groupedAppointment = $appointment->groupBy('appoint_number');

        // 予約詳細ビューにデータを渡す
        return view('appointmentDetails', compact('appointment', 'groupedAppointment'));
    }

    /**
     * 予約削除
     */
    public function destroy($id)
    {
        // 指定されたIDのユーザーを取得
        $Appointment = Appointments::findOrFail($id);

        // ユーザー削除
        $Appointment->delete();

        // 成功メッセージを表示してリストにリダイレクト
        return redirect()->route('appointmentList.index')->with('success', '予約をキャンセルしました。');
    }
}
