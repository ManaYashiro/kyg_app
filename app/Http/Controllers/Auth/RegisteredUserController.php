<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisteredUserRequest;
use App\Models\Anket;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // これを実際の アンケートリストに変更します (DB から)
        $how_did_you_hear = Anket::get();
        return view('auth.register', compact('how_did_you_hear'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisteredUserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // 電話番号が設定されていれば、ハイフンを追加またはそのままにする
        if (isset($data['phone_number'])) {
            $data['phone_number'] = $this->formatPhoneNumber($data['phone_number']);
        }

        // パスワードをハッシュ化する
        $data['password'] = Hash::make($data['password']);

        // ユーザーを作成する
        $user = User::create($data);

        // 登録イベントを発火させる
        event(new Registered($user));

        // ユーザーをログインさせる
        Auth::login($user);

        // マイページへリダイレクトする
        if (Auth::user()->role == User::ADMIN) {
            return redirect(route('admin.dashboard', absolute: false));
        }
        return redirect(route('mypage', absolute: false));
    }

    protected function formatPhoneNumber($phoneNumber)
    {
        // ハイフンがすでに含まれている場合、そのまま返す
        if (strpos($phoneNumber, '-') !== false) {
            return $phoneNumber;
        }

        // ハイフンが含まれていない場合は、数字だけを抽出
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        // 電話番号が11桁の場合にハイフンを付与してフォーマットする
        if (strlen($phoneNumber) === 11) {
            return preg_replace('/(\d{3})(\d{4})(\d{4})/', '$1-$2-$3', $phoneNumber);
        }

        // それ以外の場合、番号が正しい長さでない場合はそのまま返す（必要に応じて調整）
        return $phoneNumber;
    }
}
