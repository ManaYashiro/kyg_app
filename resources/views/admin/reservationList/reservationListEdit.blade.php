<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('予約一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto" style="max-width: 90rem;">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto mt-4">
                        <div class="container mx-auto p-4">
                            <h2 class="text-xl font-semibold mb-4">車検予約編集</h2>

                            @if (session('success'))
                                <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('admin.reservationList.update', $appointment->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- 予約日時 -->
                                <div class="mb-4">
                                    <x-input-label for="reservation_datetime" :value="__('予約日時')" />
                                    <x-text-input id="reservation_datetime" class="block mt-1 w-full" type="text" name="name"
                                        :value="old('reservation_datetime', $appointment->reservation_datetime ?? '')"/>
                                    <x-input-error :messages="$errors->get('reservation_datetime')" class="mt-2" />
                                </div>

                                <!-- 車両名 -->
                                <div class="mb-4">
                                    <x-input-label for="vehicle_name" :value="__('車両名')" />
                                    <x-text-input id="vehicle_name" class="block mt-1 w-full" type="text"
                                        name="vehicle_name" :value="old('vehicle_name', $appointment->vehicle_name ?? '')" required />
                                    <x-input-error :messages="$errors->get('vehicle_name')" class="mt-2" />
                                </div>

                                <!-- 車両番号登録 -->
                                <div class="mb-4">
                                    <x-input-label for="registration_number" :value="__('車両番号登録')" />
                                    <x-text-input id="registration_number" class="block mt-1 w-full" type="text" name="registration_number"
                                        :value="old('registration_number', $appointment->registration_number ?? '')" required />
                                    <x-input-error :messages="$errors->get('registration_number')" class="mt-2" />
                                </div>

                                <!-- 車両タイプ -->
                                <div class="mb-4">
                                    <x-input-label for="vehicle_type" :value="__('車両タイプ')" />
                                    <x-select id="vehicle_type" class="block mt-1 w-full" name="vehicle_type">
                                        <option value=""  {{ is_null($appointment->vehicle_type) ? 'selected' : '' }}>
                                            選択してください
                                        </option>
                                        <option value="sedan" {{ $appointment->vehicle_type == 'sedan' ? 'selected' : '' }}>セダン</option>
                                        <option value="suv" {{ $appointment->vehicle_type == 'suv' ? 'selected' : '' }}>SUV</option>
                                        <option value="wagon" {{ $appointment->vehicle_type == 'wagon' ? 'selected' : '' }}>ワゴン</option>
                                        <option value="track" {{ $appointment->vehicle_type == 'track' ? 'selected' : '' }}>トラック</option>
                                        <option value="other" {{ $appointment->vehicle_type == 'other' ? 'selected' : '' }}>その他</option>
                                    </x-select>
                                    <x-input-error :messages="$errors->get('preferred_contact_time')" class="mt-2" />
                                </div>

                                <!-- 車両満了日 -->
                                <div class="mb-4">
                                    <x-input-label for="inspection_due_date" :value="__('車両満了日')" />
                                    <x-text-input id="inspection_due_date" class="block mt-1 w-full" type="date" name="inspection_due_date"
                                        :value="old('inspection_due_date', $appointment->inspection_due_date ?? '')" required />
                                    <x-input-error :messages="$errors->get('inspection_due_date')" class="mt-2" />
                                </div>

                                <!-- 追加装備 -->
                                <div class="mt-4">
                                    <x-input-label for="additional_services" :value="__('追加装備')" />
                                    <x-checkbox name="additional_services[]" value="エンジンオイル交換" label="エンジンオイル交換" :checked="old('additional_services', false)" :disabled="false" class="mt-2" />
                                    <x-checkbox name="additional_services[]" value="タイヤローテション[前⇔後]" label="タイヤローテション[前⇔後]" :checked="old('additional_services', false)" :disabled="false" class="mt-2" />
                                    <x-checkbox name="additional_services[]" value="タイヤ付替[夏⇔冬シーズンチェンジ" label="タイヤ付替[夏⇔冬シーズンチェンジ" :checked="old('additional_services', false)" :disabled="false" class="mt-2" />
                                </div>
                                <!-- 更新ボタン -->
                                <div class="mb-4 flex justify-end">
                                    <!-- 更新ボタン -->
                                    <x-primary-button class="ms-3">更新</x-primary-button>
                                </div>
                            </form>
                            <!-- 削除ボタン -->
                            <form action="{{ route('admin.reservationList.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <div class="mb-4 flex justify-end">
                                    <button type="submit" class="ms-3 bg-red-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-800 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        削除
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
