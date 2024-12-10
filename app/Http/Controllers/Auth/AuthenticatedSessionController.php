<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

    public const ADMIN_DASHBOARD = '/admin/dashboard';
    public const USER_MYPAGE = '/mypage';

    /**
     * Display the login view.
     */
    public function reservationLogin(): View
    {
        return view('auth.reservation-login');
    }

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::user()->role == User::ADMIN) {
            return redirect()->to(self::ADMIN_DASHBOARD);
        }

        $intendedUrl = session()->get('url.intended', self::USER_MYPAGE);
        if ($intendedUrl === config('app.url') . self::ADMIN_DASHBOARD) {
            return redirect()->route('top');
        }
        return redirect()->intended(self::USER_MYPAGE);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
