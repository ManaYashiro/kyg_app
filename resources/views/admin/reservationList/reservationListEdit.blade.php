<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('予約一覧') }}
        </h2>
    </x-slot>

    <div class="bg-white h-full overflow-hidden shadow-sm border border-gray-800 border-r-0 border-b-0">
        <div class="h-full overflow-y-auto p-2 md:p-6 text-gray-900">
            <div class="container mx-auto p-4">
                <!-- 登録日 -->
                <div class="mb-8">
                    <x-text.custom-input-label
                        text="新規登録{{ str_repeat('　', 5) }}{{ $appointment->created_at }}{{ str_repeat('　', 10) }}最終更新{{ str_repeat('　', 5) }}{{ $appointment->updated_at }}"
                        class="mt-1 tracking-wider"
                    />
                </div>

                <h2 class="text-xl font-semibold mb-4">予約詳細</h2>

                @if (session('success'))
                    <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.reservationList.update', $appointment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- 予約番号 -->
                    <div class="mb-4">
                        <x-input-label for="reservation_number" :value="__('予約番号')" />
                        <x-text.custom-input-label text="{{ $appointment->reservation_number }}" class="mt-1" />
                    </div>

                    <!-- 予約日時 -->
                    <div class="mb-4">
                        <x-input-label for="reservation_datetime" :value="__('予約日時')"/>
                        <x-text-input id="reservation_datetime" class="block mt-1 w-1/2" type="text" name="reservation_datetime"
                            :value="old('reservation_datetime', $appointment->reservation_datetime ?? '')" required/>
                        <x-input-error :messages="$errors->get('reservation_datetime')" class="mt-2" />
                    </div>

                    <!-- 顧客名 -->
                    <div class="mb-4">
                        <x-input-label for="customer_name" :value="__('顧客名')" />
                        <x-text.custom-input-label text="{{ $appointment->customer_name }}" class="mt-1" />
                    </div>

                    <!-- 店舗 -->
                    <div class="mb-4">
                        <x-input-label for="store" :value="__('店舗')" />
                        <x-text-input id="store" class="block mt-1 w-1/2" type="text" name="store"
                            :value="old('store', $appointment->store ?? '')" required/>
                       <x-input-error :messages="$errors->get('store')" class="mt-2" />

                    </div>

                    <!-- 作業カテゴリ -->
                    <div class="mb-4">
                        <x-input-label for="taskcategory" :value="__('作業カテゴリ')" />
                        <x-text-input id="taskcategory" class="block mt-1 w-1/2" type="text" name="taskcategory"
                             :value="old('taskcategory', $appointment->taskcategory ?? '')" required/>
                        <x-input-error :messages="$errors->get('taskcategory')" class="mt-2" />
                    </div>

                    <!-- 個人・法人 -->
                    <div class="mb-4">
                        <x-input-label for="customer_name" :value="__('個人・法人')" />
                        <x-text.custom-input-label text="{{ $appointment->person_type == 1 ? '個人' : ($appointment->person_type == 2 ? '法人' : '不明') }}" class="mt-1" />
                    </div>

                    <!-- 予約する作業 -->
                    <div class="mb-4">
                        <x-input-label for="reservationtask" :value="__('予約する作業')" />
                        <x-text-input id="reservationtask" class="block mt-1 w-1/2" type="text" name="reservationtask"
                            :value="old('reservationtask', $appointment->reservationtask ?? '')" required/>
                       <x-input-error :messages="$errors->get('reservationtask')" class="mt-2" />
                    </div>

                    <!-- 備考欄 -->
                    <div class="mb-4" >
                        <x-input-label for="remarks" :value="__('備考欄')"/>
                        <x-textarea id="remarks" class="block mt-1 w-full" type="text"
                            name="remarks" :value="old('remarks', $appointment->remarks ?? '')" />
                    </div>

                    <!-- 予約状態 -->
                    <div class="mb-4">
                        <x-input-label for="reservation_status" :value="__('予約状態')" />
                        <x-select id="reservation_status" class="block mt-1 w-1/2" name="reservation_status" >
                            <option value="1" {{ $appointment->reservation_status == '1' ? 'selected' : '' }}>仮予約
                            </option>
                            <option value="2" {{ $appointment->reservation_status == '2' ? 'selected' : '' }}>本予約
                            </option>
                            <option value="0" {{ $appointment->reservation_status == '0' ? 'selected' : '' }}>予約取り消し/キャンセル
                            </option>
                        </x-select>
                        <x-input-error :messages="$errors->get('reservation_status')" class="mt-2" />
                    </div>

                    <!-- 管理メモ -->
                    <div class="mb-4">
                        <x-input-label for="admin_notes" :value="__('管理メモ')" class="whitespace-nowrap"/>
                        <x-textarea id="admin_notes" class="block mt-1 w-full" type="text"
                            name="admin_notes" :value="old('admin_notes', $appointment->admin_notes ?? '')"/>
                    </div>

                    <div class="mb-4 flex justify-end">
                    <!-- 前の画面に戻るボタン -->
                    <button onclick="window.history.back()"
                    class="ms-3 bg-gray-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    前の画面に戻る
                    </button>

                        <!-- 更新ボタン -->
                        <x-primary-button class="ms-3 !bg-blue-500 !hover:bg-blue-600 !focus:bg-blue-700">登録する</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-app-layout>
