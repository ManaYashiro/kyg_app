<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mypage') }}
        </h2>
    </x-slot>

    <div>
        {{ Auth::user()->name }}様
    </div>
    <div>
        予約状況・履歴
        <div>
            <div>
                <a href="{{ route('reservation.confirmation') }}" class="btn btn-primary">予約の確認</a>
            </div>
            <div>
                <a href="{{ route('reservation.history') }}" class="btn btn-primary">予約の履歴</a>
            </div>
        </div>
        <div>
            会員情報
            <div>
                <a href="{{ route('account.information') }}" class="btn btn-primary">登録情報の変更</a>
            </div>
            <div>
                <a href="{{ route('account.termination') }}" class="btn btn-primary">退会申請</a>
            </div>
        </div>
        <div>
            ホームへ
        </div>
    </div>
</x-app-layout>
