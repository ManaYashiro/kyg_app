<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="bg-white h-full overflow-hidden shadow-sm border border-gray-800 border-r-0 border-b-0">
        <div class="h-full overflow-y-auto p-2 md:p-6 text-gray-900">
            <form id="form-user-register" class="multiPageForm" method="POST" action="{{ $route ?? route('register') }}"
                autocomplete="off">
                @csrf
                @if (isset($route))
                    @method('PATCH')
                @endif

                <div id="page-1" class="page block">
                    @include('auth.user-profile', [
                        'formType' => $formType,
                        'submitType' => $submitType,
                        'user' => $user ?? [],
                    ])
                </div>

                <div class="mt-4 flex justify-end">
                    <!-- 更新ボタン -->
                    <x-primary-button class="ms-3">更新</x-primary-button>

                    <!-- 削除ボタン -->
                    <button type="button"
                        class="delete--model ms-3 bg-red-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-800 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        削除
                    </button>

                    <!-- 前の画面に戻るボタン -->
                    <button onclick="window.history.back()"
                        class="ms-3 bg-gray-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        前の画面に戻る
                    </button>
                </div>
            </form>

            <!-- 削除フォーム -->
            <form id="form-delete--model" action="{{ route('admin.userList.destroy', $user->id) }}" method="POST"
                class="hidden" data-title="会員">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>

    @section('styles')
    @endsection
    @push('modals')
    @endpush
    @push('scripts')
        @vite(['resources/js/modules/ajaxConfirm.js'])
        @vite(['resources/js/modules/page-navi-buttons.js'])
        @vite(['resources/js/modules/auth/register.js'])
    @endpush
</x-admin-app-layout>
