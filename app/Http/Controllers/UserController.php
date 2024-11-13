<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the user list with optional role filtering.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // ユーザー情報を取得するクエリビルダーを初期化
        $query = User::query();

        // ロールで絞り込む
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // 名前で絞り込む
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // 電話番号で絞り込む
        if ($request->has('phone_number') && $request->phone_number != '') {
            $query->where('phone_number', 'like', '%' . $request->phone_number . '%');
        }

        // 絞り込んだユーザーを5件ずつページネートして取得
        $users = $query->paginate(10); // ページごとに5件表示

        // ビューにユーザー情報を渡す
        return view('userList', compact('users'));
    }

    /**
     * ユーザーを編集
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // ユーザーを取得
        return view('userEdit', compact('user')); // 編集ページにユーザー情報を渡す
    }

    /**
     * ユーザーを削除
     */
    public function destroy($id)
    {
        // 指定されたIDのユーザーを取得
        $user = User::findOrFail($id);

        // ユーザー削除
        $user->delete();

        // 成功メッセージを表示してリストにリダイレクト
        return redirect()->route('admin.userList')->with('success', 'ユーザーを削除しました。');
    }
}
