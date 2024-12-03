<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-session-error class="mb-4" :error="session('error')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <x-text.custom-text text="パスワード再設定" class="mb-3 bottom-border-text font-bold" />
        <x-text.custom-text text="ご登録いただいているメールアドレスを入力いただき［送信する］ボタンを押下ください。" class="mb-6 text-sm" />
        <x-text.custom-text text="パスワード変更用URLをメールにてお知らせします。ログインＩＤもご確認いただけます。" class="mb-6 text-sm" />

        <div class="max-w-md mt-6 py-8 mx-auto">
            <x-text.custom-text text="パスワード情報" class="mb-2 text-sm bg-gray-text" />

            <!-- Email Address -->
            <div class="mt-4">
                <x-text.custom-text text="メールアドレス" class="text-sm left-border-text" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex flex-col items-end justify-center gap-10 mt-4">
                <x-buttons.actionbutton name="{{ __('ログイン') }}" type="submit" class="px-4 py-4" />
            </div>
        </div>
    </form>
</x-guest-layout>
