<?php

namespace App\Http\Controllers;

use App\Enums\FormTypeEnum;
use App\Enums\SubmitTypeEnum;
use App\Helpers\Log;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Requests\RegisteredUserRequest;
use App\Http\Requests\UserVehicleRequest;
use App\Models\Anket;
use App\Models\User;
use Illuminate\Http\JsonResponse;
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
        $formType = FormTypeEnum::USER_UPDATE->value;
        $submitType = SubmitTypeEnum::CONFIRM->value;
        $route = route('profile.update');
        $user = User::where('id', Auth::user()->id)->with('userVehicles')->first();
        // これを実際の アンケートリストに変更します (DB から)
        $questionnaire = Anket::get();
        return view('auth.profile', compact('user', 'route', 'formType', 'submitType', 'questionnaire'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(RegisteredUserRequest $request): JsonResponse|RedirectResponse
    {
        $data = $request->validated();
        if ($data['submit_type'] === SubmitTypeEnum::CONFIRM->value) {
            return response()->json([
                'success' => true,
                'message' => 'confirm OK'
            ]);
        }
        Log::info(User::TITLE . 'のパラメータ：' . $data['name'], $data, true);

        // 電話番号が設定されていれば、ハイフンを追加またはそのままにする
        if (isset($data['phone_number'])) {
            $data['phone_number'] = RegisteredUserController::formatPhoneNumber($data['phone_number']);
        }

        // まず、リクエストからユーザー情報を更新
        $user = $request->user();

        // パスワード以外のフィールドを更新
        $user->fill($request->except('password'));

        // パスワードが空でない場合のみ更新
        if ($request->filled('password')) {
            // パスワードが提供されていれば、ハッシュ化して保存
            $user->password = Hash::make($data['password']);
        }

        // メールアドレスが変更された場合は、メールの確認日をリセット
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // ユーザー情報を保存
        $user->save();

        // 会員登録と別に作成する
        $userVehicles = $request->validate((new UserVehicleRequest())->rules());
        $user->createVehicles($userVehicles);

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
