<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-session-error class="mb-4" :error="session('error')" />

    <x-text.custom-text text="予約者情報" class="mb-3 bottom-border-text font-bold" />
    <x-text.custom-text text="WEB予約をご利用いただくには「ログイン」が必要です。" class="text-sm" />
    <x-text.custom-text text="会員登録でご設定いただいたID・パスワードをご入力ください。" class="text-sm" />
    <div class="mt-6 flex flex-col txt-xs">
        <x-text.custom-text text="※ログインIDは任意で設定いただいたIDです。メールアドレスではありません。" class="text-blue-500" />
        <x-text.custom-text text="※パスワードをお忘れの場合は、「パスワードの再設定」より再登録をお願いいたします。" class="text-blue-500" />
    </div>

    <div class="flex flex-col md:flex-row gap-2 mt-6 py-8">
        <div class="flex-1 mx-auto px-6">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <x-text.custom-text text="登録済みの方" class="mb-2 bg-gray-text" />
                <x-text.custom-text text="ログインIDとパスワードを入力してください。" class="" />

                <!-- Login ID -->
                <div class="mt-4">
                    <x-text.custom-text text="ログインID" class="text-xs text-gray-600" />
                    <x-text-input id="loginid" :addClass="'validateAlphanumeric'" class="block mt-1 w-full" type="text"
                        name="loginid" :value="old('loginid')" minlength="4" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('loginid')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-text.custom-text text="パスワード" class="text-xs text-gray-600" />
                    <x-text-input id="password" :addClass="'validateAlphanumeric'" class="block mt-1 w-full" type="password"
                        name="password" minlength="4" maxlength="20" required />
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
                        <span class="">{{ __('※パスワードの再設定は') }}
                            <a class="underline text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('password.request') }}">
                                こちら
                            </a>
                        </span>
                    @endif
                    <x-buttons.actionbutton :id="'login'" name="{{ __('ログイン') }}" type="submit"
                        class="px-4 py-4" divClass="w-full mx-auto" />
                </div>
            </form>
        </div>
        <div class="flex-1 mx-auto px-6">
            <x-text.custom-text text="初めてご利用の方（会員登録）" class="mb-2 bg-gray-text" />
            <x-text.custom-text text="会員登録すると次回からはログインIDとパスワードの入力だけで予約できます。" class="" />

            <div class="flex flex-col items-end justify-center gap-10 mt-4">
                <x-buttons.actionbutton name="{{ __('登録して次へ') }}" type="button" class="px-4 py-4"
                    divClass="w-full mx-auto" url="{{ route('register') }}" />
            </div>
        </div>
    </div>
</x-guest-layout>
