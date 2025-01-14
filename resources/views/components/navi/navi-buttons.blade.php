@props([
    'attributes' => [], // Additional button attributes
    'class' => 'hidden sm:flex',
    'buttonColor' => 'bg-red-1000 text-white',
])

<div class="{{ $class }} sm:flex gap-3">
    @auth
        <div class="main-button flex justify-center items-center">
            <x-buttons.actionbutton name="マイページ" type="button" class="text-xs px-2 py-2" divClass="w-full"
                url="{{ route('mypage') }}" buttonColor="{{ $buttonColor }}" />
        </div>
        <div class="main-button flex justify-center items-center">
            <x-buttons.actionbutton name="ログアウト" id="logout" type="submit" class="text-xs px-2 py-2" divClass="w-full"
                url="{{ route('logout') }}" buttonColor="{{ $buttonColor }}" />
        </div>
    @else
        <div class="main-button flex justify-center items-center">
            <x-buttons.actionbutton name="ログイン" type="button" class="text-xs px-2 py-2" divClass="w-full"
                url="{{ route('login') }}" buttonColor="{{ $buttonColor }}" />
        </div>
        <div class="main-button flex justify-center items-center">
            <x-buttons.actionbutton name="会員登録" type="button" class="text-xs px-2 py-2" divClass="w-full"
                url="{{ route('register') }}" buttonColor="{{ $buttonColor }}" />
        </div>
    @endauth
</div>
