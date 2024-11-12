<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisteredUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // これを実際の アンケートリストに変更します (DB から)
        $how_did_you_hear = [
            (object) [
                'id' => 1,
                'name' => 'Google、Yahoo!等のインターネット広告',
            ],
            (object) [
                'id' => 2,
                'name' => 'Youtube、Twitter、Facebook等のSNS',
            ],
            (object) [
                'id' => 3,
                'name' => '弊社のホームページ',
            ],
            (object) [
                'id' => 4,
                'name' => '弊社からのご案内ハガキや郵便物',
            ],
            (object) [
                'id' => 5,
                'name' => '弊社のホームページ',
            ],
            (object) [
                'id' => 6,
                'name' => '店頭のポップ看板・のぼり',
            ],
            (object) [
                'id' => 7,
                'name' => '道路脇の看板やその他の屋外広告',
            ],
            (object) [
                'id' => 8,
                'name' => '新聞の折込チラシ',
            ],
            (object) [
                'id' => 9,
                'name' => '地域情報誌・フリーペーパー',
            ],
            (object) [
                'id' => 10,
                'name' => '家族・知人からの紹介',
            ],
            (object) [
                'id' => 11,
                'name' => '職場や取引先からの紹介',
            ],
        ];
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
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('mypage', absolute: false));
    }
}
