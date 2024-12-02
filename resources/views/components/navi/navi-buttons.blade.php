@auth
    <div class="flex gap-3">
        <div class="main-button flex justify-center items-center">
            <x-buttons.actionbutton name="マイページ" type="button" url="{{ route('mypage') }}" />
        </div>
        <div class="main-button flex justify-center items-center">
            <x-buttons.actionbutton name="ログアウト" type="submit" url="{{ route('logout') }}" logout="logout" />
        </div>
    </div>
@else
    <div class="flex gap-3">
        <div class="main-button flex justify-center items-center">
            <x-buttons.actionbutton name="ログイン" type="button" url="{{ route('login') }}" />
        </div>
        <div class="main-button flex justify-center items-center">
            <x-buttons.actionbutton name="会員登録" type="button" url="{{ route('register') }}" />
        </div>
    </div>
@endauth
