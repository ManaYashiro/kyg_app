<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('changeAccountInformation', [
            'users' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // まず、リクエストからユーザー情報を更新
        $user = $request->user();

        // パスワードが空でない場合のみ更新
        if ($request->filled('password')) {
            // パスワードが提供されていれば、ハッシュ化して保存
            $user->password = Hash::make($request->password);
        }

        // パスワード以外のフィールドを更新
        $user->fill($request->except('password'));

        // メールアドレスが変更された場合は、メールの確認日をリセット
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // ユーザー情報を保存
        $user->save();

        return Redirect::route('mypage')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // バリデーションルール
        $validatedData = $request->validate([
            'password' => ['required', 'current_password'],  // 現在のパスワードを確認
            'withdrawal' => ['required', 'accepted'],       // 退会同意のチェック
        ], [
            // カスタムエラーメッセージ
            'password.current_password' => 'パスワードが一致しません', // ここでカスタムメッセージを指定
            'withdrawal.required' => '退会するにはチェックしてください',  // 同意チェックのエラーメッセージ
        ]);

        // ログイン中のユーザーを取得
        $user = $request->user();

        // ログアウト処理
        Auth::logout();

        // ユーザーを削除
        $user->delete();

        // セッションの無効化と再生成
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // トップページにリダイレクト
        return Redirect::to('/');
    }
}
