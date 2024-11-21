<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
            ? (User::ADMIN ? redirect()->to(AuthenticatedSessionController::ADMIN_DASHBOARD) : redirect()->intended(AuthenticatedSessionController::USER_MYPAGE))
            : view('auth.verify-email');
    }
}
