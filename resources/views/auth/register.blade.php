<x-guest-layout>

    <form method="POST" action="{{ route('register') }}" autocomplete="off">
        @csrf

        <div class="block">
            @include('auth.user-profile')
        </div>

        <div class="hidden">
            @include('auth.user-profile-confirm')
        </div>

        <div class="flex flex-col items-center justify-center gap-10 mt-4">
            <x-buttons.actionbutton name="{{ __('次へ進む') }}" type="button" id="button-next" class="px-4 py-4"
                divClass="w-1/3" />
            <x-buttons.actionbutton name="{{ __('次へ進む') }}" type="button" id="button-prev" class="px-4 py-4 hidden"
                divClass="w-1/3" />
            <x-buttons.actionbutton name="{{ __('送信する') }}" type="submit" id="button-submit"
                class="px-4 py-4 hidden" divClass="w-1/3" />
        </div>
    </form>
</x-guest-layout>
