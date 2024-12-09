<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-session-error class="mb-4" :error="session('error')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <x-text.custom-text text="ログイン" class="mb-3 bottom-border-text font-bold" />
        <x-text.custom-text text="キムラユニティーグループのWEB予約サイトへのご訪問ありがとうございます。" class="font-bold text-sm text-blue-500" />
        <x-text.custom-text text="○ログインIDとパスワードを入力して [ログイン]ボタンを押してください。" class="mb-6 font-bold text-sm" />
        <div class="mt-3 flex flex-col gap-1">
            <x-text.custom-text text="※はじめてご利用いただく方は、お手数ですが右上の[会員登録]（スマホの場合はメニュー内）からユーザー登録をお願いいたします。" class="text-xs" />
            <x-text.custom-text text="※ログインＩＤ・パスワードをお忘れの場合は[※パスワードの再設定はこちら]へお進みください。" class="text-xs" />
        </div>

        <div class="max-w-md mt-6 py-8 mx-auto">
            <x-text.custom-text text="ログイン情報" class="mb-2 bg-gray-text" />

            <!-- Login ID -->
            <div class="mt-4">
                <x-text.custom-text text="ログインID" class="left-border-text" />
                <x-text-input id="loginid" class="block mt-1 w-full" type="text" name="loginid" :value="old('loginid')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('loginid')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-text.custom-text text="パスワード" class="left-border-text" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            {{--
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
             --}}

            <div class="flex flex-col items-end justify-center gap-10 mt-4">
                @if (Route::has('password.request'))
                    <span class="text-xs">{{ __('※パスワードの再設定は') }}
                        <a class="underline text-xs text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('password.request') }}">
                            こちら
                        </a>
                    </span>
                @endif
                <x-buttons.actionbutton :id="'login'" name="{{ __('ログイン') }}" type="submit" class="px-4 py-4"
                    divClass="w-full mx-auto" />
            </div>
        </div>
    </form>
</x-guest-layout>
