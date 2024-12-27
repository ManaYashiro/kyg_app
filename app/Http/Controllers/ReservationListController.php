<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;

class ReservationListController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointments::query()
            //対応するIDを結合して、名前を取得
            ->join('users', 'appointments.user_id', '=', 'users.id')
            ->select(
                'appointments.*',
            );

        //キーワード
        if ($request->has('name') && $request->name != '') {
            $searchTerm = '%' . $request->name . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('appointments.customer_name', 'like', $searchTerm)
                    ->orWhere('appointments.reservation_number', 'like', $searchTerm)
                    ->orWhere('appointments.main_menu', 'like', $searchTerm)
                    ->orWhere('appointments.sub_menu', 'like', $searchTerm)
                    ->orWhere('appointments.remarks', 'like', $searchTerm)
                    ->orWhere('appointments.reservation_status', 'like', $searchTerm)
                    ->orWhere('appointments.admin_notes', 'like', $searchTerm);
            });
        }

        // 予約日検索
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('reservation_datetime', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('reservation_datetime', '<=', $request->date_to);
        }

        if ($request->has('date_order')) {
            $direction = $request->date_order === 'new' ? 'desc' : 'asc';
            $query->orderBy('reservation_datetime', $direction)
                ->orderBy('appointments.reservation_number', 'asc'); // 第2ソート条件として予約番号を使用
        } else {
            // デフォルトは予約番号順
            $query->orderBy('appointments.reservation_number', 'asc');
        }

        // 絞り込んだユーザーを10件ずつページネートして取得
        $reservationlists = $query->paginate(10); // ページごとに10件表示

        //ビューに車検予約情報を渡す
        return view('admin.reservationList.reservationList', compact('reservationlists'));
    }

    /**
     * 車検予約編集
     */
    public function edit($id)
    {
        $appointment = Appointments::findOrFail($id); // 車検予約IDを取得
        return view('admin.reservationList.reservationListEdit', compact('appointment')); // 編集ページに車検予約を渡す
    }

    /**
     * 車検予約更新
     */
    public function update(Request $request, $id)
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
        // 車検予約IDを取得
        $appointment = Appointments::where('appointments.id', $id)->first();

        //車検予約内容を更新
        $appointment->update($validatedData);

        // 成功メッセージを表示してリストにリダイレクト
        return redirect()->route('admin.reservationList.index')->with('success', '車検予約を更新しました。');
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
        return redirect()->route('admin.reservationList.index')->with('success', '車検予約を削除しました。');
    }

    /**
     * CSVダウンロード
     */
    public function downloadReservationsAsCSV(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $query = Appointments::query()
            ->join('users', 'appointments.user_id', '=', 'users.id')
            ->select('appointments.*');

        // キーワード検索の適用
        if ($request->filled('name')) {
            $searchTerm = '%' . $request->name . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('appointments.customer_name', 'like', $searchTerm)
                    ->orWhere('appointments.reservation_number', 'like', $searchTerm)
                    ->orWhere('appointments.main_menu', 'like', $searchTerm)
                    ->orWhere('appointments.sub_menu', 'like', $searchTerm)
                    ->orWhere('appointments.remarks', 'like', $searchTerm)
                    ->orWhere('appointments.reservation_status', 'like', $searchTerm)
                    ->orWhere('appointments.admin_notes', 'like', $searchTerm);
            });
        }

        // 予約日範囲検索の適用
        if ($request->filled('date_from')) {
            $query->whereDate('appointments.reservation_datetime', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('appointments.reservation_datetime', '<=', $request->date_to);
        }

        // URLから直接date_orderパラメータを取得
        $dateOrder = $request->query('date_order');

        // ソート順の適用
        if ($dateOrder === 'new') {
            $query->orderBy('appointments.reservation_datetime', 'desc')
                ->orderBy('appointments.reservation_number', 'asc');
        } elseif ($dateOrder === 'old') {
            $query->orderBy('appointments.reservation_datetime', 'asc')
                ->orderBy('appointments.reservation_number', 'asc');
        } else {
            $query->orderBy('appointments.reservation_number', 'asc');
        }

        $reservationlists = $query->get();

        // 検索条件をファイル名に含める
        $fileNameParts = ['reservationList'];
        if ($request->name) {
            $fileNameParts[] = 'keyword_' . substr($request->name, 0, 10);
        }
        if ($request->date_from) {
            $fileNameParts[] = 'from_' . $request->date_from;
        }
        if ($request->date_to) {
            $fileNameParts[] = 'to_' . $request->date_to;
        }
        if ($dateOrder) {
            $fileNameParts[] = 'order_' . $dateOrder;
        }
        $fileNameParts[] = Carbon::now()->format('Ymd_His');

        // 現在の日付を使ってCSVファイル名を定義
        $csvFileName = 'reservationList_' . Carbon::now()->toDateString() . '.csv';
        $csvFile = fopen($csvFileName, 'w'); // 書き込み用にファイルを開く
        $csvColumns = $this->csvColumns(); // CSVのカラムを定義
        // UTF-8エンコーディング用にBOMを追加
        fputs($csvFile, "\xEF\xBB\xBF");

        // カラムヘッダーを書き込む
        fputcsv($csvFile, array_values($csvColumns));

        foreach ($reservationlists as $reservationlist) {
            // 行データを準備
            $row = [];
            foreach (array_keys($csvColumns) as $columnKey) {
                // 各カラムに対応する予約データをマッピング
                switch ($columnKey) {

                    case 'reservation_datetime':
                        $row[] = $reservationlist->reservation_datetime ?
                            Carbon::parse($reservationlist->reservation_datetime)->format('Y-m-d H:i') : '';
                        break;

                    case 'reservation_status':
                        $row[] = $reservationlist->getStatusTextAttribute();
                        break;

                    default:

                        $row[] = $reservationlist->$columnKey ?? '';
                        break;
                }
            }
            // 行データを書き込む
            fputcsv($csvFile, $row);
        }

        // ファイルを書き終えたら閉じる
        fclose($csvFile);

        // ファイルをダウンロードとして返す
        return Response::download(public_path($csvFileName))->deleteFileAfterSend(true);
    }

    public function csvColumns(): array
    {
        return [
            'reservation_number' => '予約番号',
            'reservation_datetime' => '予約日時',
            'customer_name' => '顧客名',
            'main_menu' => 'メインメニュー名',
            'sub_menu' => 'サブメニュー名',
            'store' => 'ご希望の店舗	',
            'taskcategory' => '作業カテゴリ',
            'reservationtask' => '予約する作業',
            'user_vehicle_id' => '車両台数',
            'additional_services	' => '	追加整備',
            'inspection_due_date' => '	車検満了日	',
            'past_service_history' => '過去の利用履歴	',
            'requirement' => '予約ご要望',
            'remarks' => '備考欄',
            'reservation_count' => '予約数',
            'reservation_status' => '予約状況',
            'admin_notes' => '管理メモ',
        ];
    }
}
