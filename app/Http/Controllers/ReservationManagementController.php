<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;

class ReservationManagementController extends Controller
{
    public function index(Request $request)
    {

        $query = Appointments::query()
            //対応するIDを結合して、名前を取得
            ->join('users', 'appointments.user_id', '=', 'users.id')
            ->select('appointments.*',
            'users.name',
        );

        // 予約番号での検索
        if ($request->filled('appoint_number')) {
            $query->where('appoint_number', 'like', '%' . $request->appoint_number . '%');
        }

        // 名前を検索
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // 絞り込んだユーザーを10件ずつページネートして取得
        $reservationmanagements = $query->paginate(10);// ページごとに10件表示

        //ビューに車検予約情報を渡す
        return view('admin.reservationmanagement.reservationmanagement',compact('reservationmanagements'));
    }
    /**
     * 車検予約編集
     */
    public function edit($id)
    {
        $appointment = Appointments::findOrFail($id); // 車検予約を取得
        return view('admin.reservationmanagement.reservationmanagementEdit', compact('appointment')); // 編集ページに車検予約を渡す
    }

    /**
     * 車検予約更新
     */
    public function update(Request $request,  $id)
    {

        //バリデーション
        $validatedData = $request->validate([
            'reservation_datetime' => 'nullable|date',
            'vehicle_name' => 'required|string',
            'registration_number' => 'required|string',
            'vehicle_type' => 'required|string',
            'inspection_due_date' => 'required|date',
            'additional_services' => 'array',
        ]);
        //JSON_UNESCAPED_UNICODEで保存
        $validatedData['additional_services'] = json_encode($validatedData['additional_services'], JSON_UNESCAPED_UNICODE);
        // 車検予約を取得
        $appointment = Appointments::where('appointments.id',$id)->first();

        //車検予約を更新
        $appointment->update($validatedData);

        // 成功メッセージを表示してリストにリダイレクト
        return redirect()->route('admin.reservationmanagement.index')->with('success', '車検予約を更新しました。');
    }

    /**
     * 車検予約削除
     */
    public function destroy($id)
    {
        // 指定された車検IDを取得
        $appointment = Appointments::findOrFail($id);

        // 車検予約削除
        $appointment->delete();

        // 成功メッセージを表示してリストにリダイレクト
        return redirect()->route('admin.reservationmanagement.index')->with('success', '車検予約を削除しました。');
    }

}
