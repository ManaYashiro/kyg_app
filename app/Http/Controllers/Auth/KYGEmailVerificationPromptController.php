<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KYGEmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        $redirectUrl = $request->user()->role == User::ADMIN ? KYGAuthenticatedSessionController::ADMIN_DASHBOARD : KYGAuthenticatedSessionController::USER_MYPAGE;
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended($redirectUrl)
            : view('auth.verify-email');
    }
}
