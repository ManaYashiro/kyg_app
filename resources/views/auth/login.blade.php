<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-session-error class="mb-4" :error="session('error')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <x-text.main text="ログイン" class="mb-3" border="b" />
        <x-text.main text="キムラユニティーグループのWEB予約サイトへのご訪問ありがとうございます。" color="blue" />
        <x-text.main text="○ログインIDとパスワードを入力して [ログイン]ボタンを押してください。" />
        <div class="mt-3 flex flex-col gap-1">
            <x-text.plain text="※はじめてご利用いただく方は、お手数ですが右上の[会員登録]（スマホの場合はメニュー内）からユーザー登録をお願いいたします。" size="xs" />
            <x-text.plain text="※ログインＩＤ・パスワードをお忘れの場合は[※パスワードの再設定はこちら]へお進みください。" size="xs" />
        </div>

        <!-- Login ID -->
        <div>
            <x-input-label for="loginid" :value="__('Login ID')" />
            <x-text-input id="loginid" class="block mt-1 w-full" type="text" name="loginid" :value="old('loginid')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('loginid')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
