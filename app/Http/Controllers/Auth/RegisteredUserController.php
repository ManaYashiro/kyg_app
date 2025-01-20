<?php

namespace App\Http\Controllers\Auth;

use App\Enums\FormTypeEnum;
use App\Enums\SubmitTypeEnum;
use App\Enums\UserRoleEnum;
use App\Helpers\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisteredUserRequest;
use App\Http\Requests\UserVehicleRequest;
use App\Models\TransportBranch;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $formType = FormTypeEnum::USER_REGISTER->value;
        $submitType = SubmitTypeEnum::CONFIRM->value;
        $branches = TransportBranch::orderBy('display_order')->get();
        return view('auth.profile', compact('formType', 'submitType', 'branches'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisteredUserRequest $request): JsonResponse|RedirectResponse
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
            $data['phone_number'] = $this::formatPhoneNumber($data['phone_number']);
        }

        // パスワードをハッシュ化する
        $data['password'] = Hash::make($data['password']);

        // ユーザーを作成する
        $user = User::create($data);

        // 会員登録と別に作成する
        $userVehicles = $request->validate((new UserVehicleRequest())->rules());
        $user->createVehicles($userVehicles);

        // 登録イベントを発火させる
        event(new Registered($user));

        // ユーザーをログインさせる
        // Auth::login($user);

        // 管理者がユーザーを登録
        if (Auth::check()) {
            if (Auth::user()->role->value === UserRoleEnum::Admin->value) {
                return redirect()->route('admin.userList.index')->with('success', 'ユーザーを作成しました');
            }
        }

        //未ローグインで確認メール送信して、トップ画面にリダイレクトします。
        $message = 'ご登録いただき、ありがとうございます。<br />お送りした確認用URLをメールからご確認の上、クリックしてください。';
        Session::remove('created_user_role');
        return redirect(route('top', absolute: false))->with('verify-email', $message);
    }

    public static function formatPhoneNumber($phoneNumber)
    {
        return $phoneNumber;
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
