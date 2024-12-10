<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mypage') }}
        </h2>
    </x-slot>

    <div>
        <x-text.custom-text :text="Auth::user()->name . '様　マイページ'" class="bottom-border-text" />
    </div>

    <div class="mypage my-5">
        <div class="flex gap-1">
            <div class="flex-1 m-3 px-5">
                <x-text.custom-text text="予約状況・履歴" class="mb-2 bg-gray-text" />
                <div class="flex gap-2 justify-center items-center">
                    <a href="{{ route('appointment.confirmation') }}" class="button-container">
                        <div
                            class="flex flex-col justify-center items-center gap-2 border border-gray-400 hover:bg-gray-100 transition-colors duration-500 rounded-sm py-4 px-1">
                            <i class="fa-regular fa-calendar text-red-700 text-3xl"></i>
                            <span class="text-gray-600">予約の確認</span>
                        </div>
                    </a>
                    <a href="{{ route('appointmentList.index') }}" class="button-container">
                        <div
                            class="flex flex-col justify-center items-center gap-2 border border-gray-400 hover:bg-gray-100 transition-colors duration-500 rounded-sm py-4 px-1">
                            <i class="fa-solid fa-user-clock text-red-700 text-3xl"></i>
                            <span class="text-gray-600">予約の履歴</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="flex-1 m-3 px-5">
                <x-text.custom-text text="会員情報" class="mb-2 bg-gray-text" />
                <div class="flex gap-2 justify-center items-center">
                    <a href="{{ route('profile.edit') }}" class="button-container">
                        <div
                            class="flex flex-col justify-center items-center gap-2 border border-gray-400 hover:bg-gray-100 transition-colors duration-500 rounded-sm py-4 px-1">
                            <i class="fa-regular fa-circle-user text-red-700 text-3xl"></i>
                            <span class="text-gray-600">登録情報の変更</span>
                        </div>
                    </a>
                    <a href="{{ route('account.termination') }}" class="button-container">
                        <div
                            class="flex flex-col justify-center items-center gap-2 border border-gray-400 hover:bg-gray-100 transition-colors duration-500 rounded-sm py-4 px-1">
                            <i class="fa-solid fa-arrow-right-from-bracket text-red-700 text-3xl"></i>
                            <span class="text-gray-600">退会申請</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <x-buttons.actionbutton :id="'login'" name="{{ __('ホームヘ') }}" type="button" class="mt-5 px-4 py-4"
            divClass="w-1/3 mx-auto" url="{{ route('top') }}" :isButtonRed="false" />
    </div>

    @section('styles')
        @vite(['resources/css/modules/auth/mypage.css'])
    @endsection
</x-app-layout>
