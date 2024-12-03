<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-session-error class="mb-4" :error="session('error')" />

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <x-text.custom-text text="パスワード再設定" class="mb-3 bottom-border-text font-bold" />
        <x-text.custom-text text="メールアドレスと新しいパスワードを入力して「パスワード再設定を送信する」をクリックしてください。" class="mb-6 text-sm" />

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mt-4">
            <x-text.custom-text text="メールアドレス" class="text-sm left-border-text" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-text.custom-text text="パスコード" class="text-sm left-border-text" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-end justify-center gap-10 mt-4">
            <x-buttons.actionbutton name="{{ __('パスワード再設定を送信する') }}" type="submit" class="px-4 py-4" />
        </div>
    </form>
</x-guest-layout>
