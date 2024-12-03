<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View|RedirectResponse
    {
        $loginid = null;
        $email = null;
        $token = $request->route('token');

        // ブレード ファイルにログイン ID を表示するには、有効なトークンをすべて取得し、それらを 1 つずつ比較する必要があります。
        $passwordResetToken = DB::table('password_reset_tokens')
            ->where('created_at', '>=', Carbon::now()->subMinutes(config('auth.passwords.users.expire')))
            ->get()
            ->first(function ($data) use ($token) {
                return Hash::check($token, $data->token);
            });

        if ($passwordResetToken) {
            $data = User::where('email', $passwordResetToken->email)->select('loginid', 'email')->first();
            $loginid = $data->loginid;
            $email = $data->email;
            return view('auth.reset-password', ['request' => $request, 'loginid' => $loginid, 'email' => $email]);
        }

        $messages = ['検証トークンが無効です。', '新しいトークンを作成してください。'];
        $actionText = "パスワードを設定に戻る";
        $actionUrl = route('password.request');
        return redirect()->route('auth.response')->with(['success' => "false", 'messages' => $messages, 'actionText' => $actionText, 'actionUrl' => $actionUrl]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
