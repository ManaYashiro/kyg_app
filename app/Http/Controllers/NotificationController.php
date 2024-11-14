<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    /**
     * Display the user list with optional role filtering.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $notifications = Notification::all();

        return view('admin.notifications.notificationSetting', compact('notifications'));
    }

    /**
     * ユーザー更新
     */
    public function store(Request $request)
    {
        // バリデーション
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category' => 'required',
            'published_at' => 'nullable|date',
            'is_active' => 'required|boolean',
            'image' => 'nullable|file|mimes:pdf,jpg,png',
        ]);

        // 画像がアップロードされた場合
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // 元のファイル名を取得
            $originalFileName = $request->file('image')->getClientOriginalName();

            // 画像ファイルをnotificationsディレクトリに保存
            $imagePath = $request->file('image')->storeAs('notifications', $originalFileName, 'public');

            // 保存したパスをvalidatedDataに追加
            $validatedData['image'] = $imagePath;
        }

        // IDが存在する場合は更新、存在しない場合は新規作成
        $notification = Notification::updateOrCreate(
            ['id' => $request->notification_id], // idが存在する場合、それを基に更新
            $validatedData // 新規作成または更新するデータ
        );

        // 成功メッセージの設定
        $message = $notification->wasRecentlyCreated
            ? __('登録しました')  // 新規作成の場合
            : __('更新しました');  // 更新の場合

        // リダイレクトして成功メッセージを表示
        return redirect('/admin/notificationSetting')->with('success', $message);
    }

    /**
     * ユーザー削除
     */
    public function destroy($id)
    {
        // 指定されたIDの通知を探して削除
        $notification = Notification::findOrFail($id);
        $notification->delete();

        // 削除後、一覧画面を再度表示
        return redirect()->route('admin.notificationSetting.index')->with('success', '削除しました');
    }
}
