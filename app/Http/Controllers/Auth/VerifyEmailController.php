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

        if ($request->user()->hasVerifiedEmail()) {
            return (User::ADMIN ? redirect()->to(AuthenticatedSessionController::ADMIN_DASHBOARD) : redirect()->intended(AuthenticatedSessionController::TOP_PAGE));
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return (User::ADMIN ? redirect()->to(AuthenticatedSessionController::ADMIN_DASHBOARD) : redirect()->intended(AuthenticatedSessionController::TOP_PAGE));
    }
}
