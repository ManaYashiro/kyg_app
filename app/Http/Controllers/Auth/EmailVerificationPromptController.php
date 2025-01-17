<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRoleEnum;
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
            ? (UserRoleEnum::Admin->value ? redirect()->to(AuthenticatedSessionController::ADMIN_DASHBOARD) : redirect()->intended(AuthenticatedSessionController::TOP_PAGE))
            : view('auth.verify-email');
    }
}
