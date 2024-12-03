<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // パスワード再設定時に、ログインIDを使用している場合は、ログインIDとsendResetLinkパラメータの検証を変更します。
        // 'loginid' => 'required|string|min:4|max:10',
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.

        $foundUser = User::where('email', $request->input('email'))->first();
        if ($foundUser) {
            $status = Password::sendResetLink(
                $request->only('email')
            );
        } else {
            // show a send url success even if email was not found
            $status = Password::RESET_LINK_SENT;
        }

        return $status == Password::RESET_LINK_SENT
            ? redirect()->route('password.response')->with('success', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }

    /**
     * Display the password reset link request view.
     */
    public function response(): View
    {
        return view('auth.forgot-password-response');
    }
}
