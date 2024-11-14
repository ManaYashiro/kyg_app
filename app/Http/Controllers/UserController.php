<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
     * ユーザー編集
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // ユーザーを取得
        return view('userEdit', compact('user')); // 編集ページにユーザー情報を渡す
    }

    /**
     * ユーザー更新
     */
    public function update(ProfileUpdateRequest $request, $userList): RedirectResponse
    {
        // リクエストからユーザー情報を更新
        $user = User::where('id', $request->route('userList'))->first();

        // パスワード以外のフィールドを更新
        $user->update($request->except('password'));

        // メールアドレスが変更された場合は、メールの確認日をリセット
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // ユーザー情報を保存
        $user->save();

        return Redirect::route('admin.userList.index')->with('success', 'ユーザーを更新しました');
    }

    /**
     * ユーザー削除
     */
    public function destroy($id)
    {
        // 指定されたIDのユーザーを取得
        $user = User::findOrFail($id);

        // ユーザー削除
        $user->delete();

        // 成功メッセージを表示してリストにリダイレクト
        return redirect()->route('admin.userList.index')->with('success', 'ユーザーを削除しました。');
    }
}
