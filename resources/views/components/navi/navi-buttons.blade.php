@auth
    <div class="flex gap-3">
        <x-buttons.actionbutton name="マイページ" type="href" url="{{ route('mypage') }}" />
        <x-buttons.actionbutton name="ログアウト" type="href" url="{{ route('logout') }}" logout="logout" />
    </div>
@else
    <div class="flex gap-3">
        <x-buttons.actionbutton name="ログイン" type="href" url="{{ route('login') }}" />
        <x-buttons.actionbutton name="会員登録" type="href" url="{{ route('register') }}" />
    </div>
@endauth
