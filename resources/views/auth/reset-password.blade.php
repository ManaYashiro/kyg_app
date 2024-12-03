<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-session-error class="mb-4" :error="session('error')" />

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <x-text.custom-text text="パスワード再設定" class="mb-3 bottom-border-text font-bold" />
        <x-text.custom-text text="新しいパスワードを入力してください。" class="mb-6 text-sm" />

        {{-- Password Reset Token --}}
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        {{-- Hidden Email --}}
        <input type="hidden" name="email" value="{{ $email }}">

        <!-- Login ID -->
        <div class="mt-4">
            <x-text.custom-text text="ログインID" class="text-sm left-border-text" />
            <x-text.custom-text :text="$loginid" class="mb-6 text-xs" />
            <x-input-error :messages="$errors->get('loginid')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-text.custom-input-label text="パスワード" class="mb-2" option="必須" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autofocus />
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
