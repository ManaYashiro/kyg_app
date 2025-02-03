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
                        class="mt-1 tracking-wider" />
                </div>
                <x-text.custom-text text="予約詳細" class="mb-3 bottom-border-text font-bold" />

                @if (session('success'))
                    <div class="bg-green-200 text-green-700 p-2 rounded mb-3" id="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.reservationList.update', $appointment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-y-2">
                        <!-- 予約番号 -->
                        <x-text.custom-input-label for="reservation_number" text="予約番号"
                            class="mb-2 left-border-text" />
                        <label class="mb-3">{{ $appointment->reservation_number }}</label>

                        <!-- 予約日時 -->
                        <x-text.custom-input-label for="reservation_datetime" text="予約日時"
                            class="mb-2 left-border-text" />
                        <label
                            class="mb-3">{{ date('Y/m/d H:i', strtotime($appointment->reservation_datetime)) }}</label>

                        <!-- 顧客名 -->
                        <x-text.custom-input-label for="customer_name" text="顧客名" class="mb-2 left-border-text" />
                        <label class="mb-3">{{ $appointment->customer_name }}</label>

                        <!-- 店舗 -->
                        <x-text.custom-input-label for="store" text="店舗" class="mb-2 left-border-text" />
                        <label class="mb-3">{{ $appointment->store }}</label>

                        <!-- 作業カテゴリ -->
                        <x-text.custom-input-label for="inspection_type" text="作業カテゴリ" class="mb-2 left-border-text" />
                        <label class="mb-3">{{ $appointment->inspection_type }}</label>

                        <!-- 作業種別 -->
                        <x-text.custom-input-label for="work_type" text="作業種別" class="mb-2 left-border-text" />
                        <label class="mb-3">{{ $appointment->work_type }}</label>

                        <!-- 個人・法人 -->
                        <x-text.custom-input-label for="person_type" text="個人・法人" class="mb-2 left-border-text" />
                        <label class="mb-3">
                            {{ $appointment->person_type == 1 ? '個人' : ($appointment->person_type == 2 ? '法人' : '不明') }}
                        </label>

                        <!-- 予約する作業 -->
                        <x-text.custom-input-label for="reservation_task_name" text="予約する作業"
                            class="mb-2 left-border-text" />
                        <label class="mb-3">{{ $appointment->reservation_task_name }}</label>

                        <!-- 車両数No -->
                        <x-text.custom-input-label for="user_vehicle_id" text="車両数No" class="mb-2 left-border-text" />
                        <label class="mb-3">{{ $appointment->user_vehicle_id }}台目</label>

                        <!-- 追加設備 -->
                        <x-text.custom-input-label for="additional_services" text="追加設備"
                            class="mb-2 left-border-text" />
                        @foreach (explode(',', $appointment->additional_services) as $service)
                            <div>{{ trim($service) }}</div>
                        @endforeach

                        <!-- 車検満期日 -->
                        <x-text.custom-input-label for="inspection_due_date" text="車検満期日"
                            class="mb-2 left-border-text" />
                        <label class="mb-3">
                            {{ \Carbon\Carbon::parse($appointment->inspection_due_date)->format('Y/m/d') }}
                        </label>

                        <!-- 備考欄 -->
                        <div id="container-remarks" class="mt-4">
                            <x-text.custom-input-label for="remarks" text="備考欄" class="mb-2" option="任意" />
                            <x-textarea id="remarks" class="w-full h-24" type="text" name="remarks"
                                :value="old('remarks', $appointment->remarks ?? '')" maxlength="1024"/>
                        </div>

                        <!-- 予約状態 -->
                        <div id="container-prefecture" class="mt-4">
                            <x-text.custom-input-label for="reservation_status" text="予約状態" class="mb-2"
                                option="必須" />
                            <x-select id="reservation_status" class="w-1/1" name="reservation_status" required>
                                <option value="1" {{ $appointment->reservation_status == '1' ? 'selected' : '' }}>
                                    仮予約</option>
                                <option value="2" {{ $appointment->reservation_status == '2' ? 'selected' : '' }}>
                                    本予約</option>
                                <option value="0" {{ $appointment->reservation_status == '0' ? 'selected' : '' }}>
                                    予約取り消し/キャンセル
                                </option>
                            </x-select>
                            <x-input-error :messages="$errors->get('reservation_status')" class="mt-2" />
                        </div>

                        <!-- 管理メモ -->
                        <div id="container-remarks" class="mt-4">
                            <x-text.custom-input-label for="admin_notes" text="管理メモ" class="mb-2" option="任意" />
                            <x-textarea id="admin_notes" class="w-full h-24" type="text" name="admin_notes"
                                :value="old('admin_notes', $appointment->admin_notes ?? '')" maxlength="128" />
                        </div>

                        <div class="mt-4 flex justify-end">
                            <!-- 前の画面に戻るボタン -->
                            <button type="button"
                                onclick="window.location.href='{{ route('admin.reservationList.index') }}'"
                                class="ms-3 bg-gray-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                前の画面に戻る
                            </button>

                            <!-- 更新ボタン -->
                            <x-primary-button class="ms-3">
                                登録する
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-app-layout>
