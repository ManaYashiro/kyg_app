@props([
    'attributes' => [], // Additional button attributes
])

@auth
    <div class="flex gap-3">
        <div class="main-button flex justify-center items-center">
            <x-buttons.actionbutton name="マイページ" type="button" class="text-xs px-2 py-2" divClass="w-full"
                url="{{ route('mypage') }}" />
        </div>
        <div class="main-button flex justify-center items-center">
            <x-buttons.actionbutton name="ログアウト" type="submit" class="text-xs px-2 py-2" divClass="w-full"
                url="{{ route('logout') }}" logout="logout" />
        </div>
    </div>
@else
    <div class="flex gap-3">
        <div class="main-button flex justify-center items-center">
            <x-buttons.actionbutton name="ログイン" type="button" class="text-xs px-2 py-2" divClass="w-full"
                url="{{ route('login') }}" />
        </div>
        <div class="main-button flex justify-center items-center">
            <x-buttons.actionbutton name="会員登録" type="button" class="text-xs px-2 py-2" divClass="w-full"
                url="{{ route('register') }}" />
        </div>
    </div>
@endauth
