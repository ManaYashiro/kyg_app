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

                <div class="font-bold">予約詳細</div>

                @if (session('success'))
                    <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.reservationList.update', $appointment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-y-2 pl-8">
                        <!-- 予約番号 -->
                        <div class="flex items-center">
                            <div class="w-4"></div>
                            <div class="w-28">
                                <x-input-label for="reservation_number" :value="__('予約番号')" />
                            </div>
                            <div>
                                <x-text.custom-input-label text="{{ $appointment->reservation_number }}" />
                            </div>
                        </div>

                        <!-- 予約日時 -->
                        <div class="flex items-center">
                            <div class="w-4 text-red-500">*</div>
                            <div class="w-28">
                                <x-input-label for="reservation_datetime" :value="__('予約日時')" />
                            </div>
                            <div>
                                <x-text.custom-input-label text="{{ date('Y/m/d H:i:s', strtotime($appointment->reservation_datetime)) }}" />
                            </div>
                        </div>

                        <!-- 顧客名 -->
                        <div class="flex items-center">
                            <div class="w-4"></div>
                            <div class="w-28">
                                <x-input-label for="customer_name" :value="__('顧客名')" />
                            </div>
                            <div>
                                <x-text.custom-input-label text="{{ $appointment->customer_name }}" />
                            </div>
                        </div>

                        <!-- 店舗 -->
                        <div class="flex items-center">
                            <div class="w-4 text-red-500">*</div>
                            <div class="w-28">
                                <x-input-label for="store" :value="__('店舗')" />
                            </div>
                            <div>
                                <x-text.custom-input-label text="{{ $appointment->store }}" />
                            </div>
                        </div>

                        <!-- 作業カテゴリ -->
                        <div class="flex items-center">
                            <div class="w-4 text-red-500">*</div>
                            <div class="w-28">
                                <x-input-label for="taskcategory" :value="__('作業カテゴリ')" />
                            </div>
                            <div>
                                <x-text.custom-input-label text="{{ $appointment->inspection_type }}" />
                            </div>
                        </div>

                        <!-- 作業種別 -->
                        <div class="flex items-center">
                            <div class="w-4 text-red-500">*</div>
                            <div class="w-28">
                                <x-input-label for="taskcategory" :value="__('作業種別')" />
                            </div>
                            <div>
                                <x-text.custom-input-label text="{{ $appointment->work_type }}" />
                            </div>
                        </div>

                        <!-- 個人・法人 -->
                        <div class="flex items-center">
                            <div class="w-4 text-red-500">*</div>
                            <div class="w-28">
                                <x-input-label for="customer_name" :value="__('個人・法人')" />
                            </div>
                            <div>
                                <x-text.custom-input-label text="{{ $appointment->person_type == 1 ? '個人' : ($appointment->person_type == 2 ? '法人' : '不明') }}" />
                            </div>
                        </div>

                        <!-- 予約する作業 -->
                        <div class="flex items-center">
                            <div class="w-4 text-red-500">*</div>
                            <div class="w-28">
                                <x-input-label for="reservationtask" :value="__('予約する作業')" />
                            </div>
                            <div>
                                <x-text.custom-input-label text="{{ $appointment->reservation_task_name }}" />
                            </div>
                        </div>

                        <!-- 車両数No -->
                        <div class="flex items-center">
                            <div class="w-4 text-red-500">*</div>
                            <div class="w-28">
                                <x-input-label for="remarks" :value="__('車両数No')" />
                            </div>
                            <div>
                                <x-text.custom-input-label text="{{ $appointment->user_vehicle_id }}台目" />
                            </div>
                        </div>

                        <!-- 追加設備 -->
                        <div class="flex">
                            <div class="w-4 text-red-500">*</div>
                            <div class="w-28">
                                <x-input-label for="remarks" :value="__('追加設備')" />
                            </div>
                            <div class="space-y-1">
                                @foreach(explode(',', $appointment->additional_services) as $service)
                                    <div>{{ trim($service) }}</div>
                                @endforeach
                            </div>
                        </div>

                        <!-- 車検満期日 -->
                        <div class="flex items-center">
                            <div class="w-4"></div>
                            <div class="w-28">
                                <x-input-label for="remarks" :value="__('車検満期日')" />
                            </div>
                            <div>
                                <x-text.custom-input-label text="{{ $appointment->inspection_due_date }}" />
                            </div>
                        </div>

                        <!-- 備考欄 -->
                        <div class="flex">
                            <div class="w-4"></div>
                            <div class="w-28">
                                <x-input-label for="remarks" :value="__('備考欄')" />
                            </div>
                            <div class="flex-1">
                                <x-textarea id="remarks" class="w-full h-24" type="text"
                                    name="remarks" :value="old('remarks', $appointment->remarks ?? '')" maxlength="500"/>
                                     {{-- 最大文字数仮500 --}}
                            </div>
                        </div>

                        <!-- 予約状態 -->
                        <div class="flex items-center">
                            <div class="w-4 text-red-500">*</div>
                            <div class="w-28">
                                <x-input-label for="reservation_status" :value="__('予約状態')" />
                            </div>
                            <div>
                                <x-select id="reservation_status" class="w-1/1" name="reservation_status" required>
                                    <option value="1" {{ $appointment->reservation_status == '1' ? 'selected' : '' }}>仮予約</option>
                                    <option value="2" {{ $appointment->reservation_status == '2' ? 'selected' : '' }}>本予約</option>
                                    <option value="0" {{ $appointment->reservation_status == '0' ? 'selected' : '' }}>予約取り消し/キャンセル</option>
                                </x-select>
                                <x-input-error :messages="$errors->get('reservation_status')" class="mt-2" />
                            </div>
                        </div>

                        <!-- 管理メモ -->
                        <div class="flex">
                            <div class="w-4"></div>
                            <div class="w-28">
                                <x-input-label for="admin_notes" :value="__('管理メモ')" class="whitespace-nowrap" />
                            </div>
                            <div class="flex-1">
                                <x-textarea id="admin_notes" class="w-full h-24" type="text"
                                    name="admin_notes" :value="old('admin_notes', $appointment->admin_notes ?? '')" maxlength="128"/>
                            </div>
                        </div>

                        <div class="mb-4 flex justify-center">
                            <!-- 前の画面に戻るボタン -->
                            <button type="button" onclick="window.location.href='{{ route('admin.reservationList.index') }}'"
                            class="ms-3 bg-gray-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            戻る
                            </button>

                            <!-- 更新ボタン -->
                            <x-primary-button class="ms-40 !bg-blue-500 !hover:bg-blue-600 !focus:bg-blue-700">
                                登録する
                            </x-primary-button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-app-layout>
