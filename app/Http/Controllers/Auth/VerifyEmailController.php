<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $redirectUrl = $request->user()->role == User::ADMIN ? AuthenticatedSessionController::ADMIN_DASHBOARD : AuthenticatedSessionController::USER_MYPAGE;

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended($redirectUrl . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended($redirectUrl . '?verified=1');
    }
}
