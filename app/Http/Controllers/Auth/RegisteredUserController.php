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
                'name' => 'Google',
            ],
            (object) [
                'id' => 2,
                'name' => 'Youtube',
            ],
            (object) [
                'id' => 3,
                'name' => 'Home Page',
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
