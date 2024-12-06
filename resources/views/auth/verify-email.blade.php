<x-guest-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-session-error class="mb-4" :error="session('error')" />

    <div class="">

        <x-text.custom-text text="認証メールを再送信" class="mb-3 bottom-border-text font-bold" />
        <x-text.custom-text text="「認証メールを再送信する」をクリックしてください" class="mb-6 text-sm" />

        <div class="flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div class="max-w-md mx-auto">
                    <div class="flex flex-col items-end justify-center gap-10">
                        <x-buttons.actionbutton name="{{ __('認証メールを再送信する') }}" type="submit" class="px-4 py-4"
                            divClass="w-full mx-auto" />
                    </div>
                </div>
            </form>

            {{--
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('ログアウト') }}
                </button>
            </form>
            --}}
        </div>
    </div>
</x-guest-layout>
