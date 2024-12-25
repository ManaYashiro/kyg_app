<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="h-full overflow-y-auto p-6 text-gray-900">

        <div class="mb-3 bottom-border-text font-bold">
            <span class="">予約一覧</span>
        </div>

        <h2 class="text-sm font-semibold">予約詳細</h2>
        <div class="container mx-auto p-4">

            @if (session('success'))
                <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('appointmentList.confirm') }}">
                @csrf <!-- CSRFトークンの追加 -->
                <input type="hidden" name="id" value="{{ $appointment->id }}">
                <!-- 予約番号 -->
                <div class="mb-4">
                    <x-input-label for="reservation_number" :value="__('予約番号')" />
                    <x-data-display :value="$appointment->reservation_number ?? ''" />
                    <input type="hidden" name="reservation_number" value="{{ $appointment->reservation_number ?? '' }}">
                </div>

                <!-- 予約日時 -->
                <div class="mb-4">
                    <x-input-label for="reservation_datetime" :value="__('予約日時')" />
                    <x-data-display :value="$appointment->reservation_datetime ?? ''" />
                    <input type="hidden" name="reservation_datetime" value="{{ $appointment->reservation_datetime ?? '' }}">
                </div>

                <!-- 希望店舗 -->
                <div class="mb-4">
                    <x-input-label for="store" :value="__('希望店舗')" />
                    <x-data-display :value="$appointment->store ?? ''" />
                    <input type="hidden" name="store" value="{{ $appointment->store ?? '' }}">
                </div>

                <!-- 作業カテゴリー -->
                <div class="mb-4">
                    <x-input-label for="taskcategory" :value="__('作業カテゴリー')" />
                    <x-data-display :value="$appointment->taskcategory ?? ''" />
                    <input type="hidden" name="taskcategory" value="{{ $appointment->taskcategory ?? '' }}">
                </div>

                <!-- 予約する作業 -->
                <div class="mb-4">
                    <x-input-label for="reservationtask" :value="__('予約する作業')" />
                    <x-data-display :value="$appointment->reservationtask ?? ''" />
                    <input type="hidden" name="reservationtask" value="{{ $appointment->reservationtask ?? '' }}">
                </div>

                <!-- 車両 -->
                <div class="mb-4">
                    <x-text.custom-input-label text="【車両選択】複数お車をご登録されている方は、何台目に登録されているお車か選択してください。" class="mb-2"
                        option="必須" />
                    <x-select id="user_vehicle_id" class="block mt-1 w-full" name="user_vehicle_id" required>
                        <!-- Loop through vehicle options -->
                        @foreach ([1 => '1台目', 2 => '2台目', 3 => '3台目'] as $key => $vehicleLabel)
                            <option value="{{ $key }}" @selected(old('user_vehicle_id', $appointment->user_vehicle_id) == $key)>
                                {{ $vehicleLabel }}
                            </option>
                        @endforeach
                    </x-select>
                </div>

                <!-- 追加装備 -->
                <div class="mt-4">
                    <h5>
                        <x-text.custom-input-label text="【追加整備】本作業とあわせて追加作業を依頼したい場合にお選びください。" class="mb-2"
                            option="任意" />
                    </h5>
                    <x-checkbox name="additional_services[]" value="エンジンオイル交換" label="エンジンオイル交換" :checked="in_array(
                        'エンジンオイル交換',
                        old(
                            'additional_services',
                            is_array($appointment->additional_services)
                                ? $appointment->additional_services
                                : explode(',', $appointment->additional_services ?? ''),
                        ),
                    )"
                        :disabled="false" class="mt-2" />
                    <x-checkbox name="additional_services[]" value="タイヤローテション[前⇔後]" label="タイヤローテション[前⇔後]"
                        :checked="in_array(
                            'タイヤローテション[前⇔後]',
                            old(
                                'additional_services',
                                is_array($appointment->additional_services)
                                    ? $appointment->additional_services
                                    : explode(',', $appointment->additional_services ?? ''),
                            ),
                        )" :disabled="false" class="mt-2" />
                    <x-checkbox name="additional_services[]" value="タイヤ付替[夏⇔冬シーズンチェンジ]" label="タイヤ付替[夏⇔冬シーズンチェンジ]"
                        :checked="in_array(
                            'タイヤ付替[夏⇔冬シーズンチェンジ]',
                            old(
                                'additional_services',
                                is_array($appointment->additional_services)
                                    ? $appointment->additional_services
                                    : explode(',', $appointment->additional_services ?? ''),
                            ),
                        )" :disabled="false" class="mt-2" />
                </div>

                <!-- 車検満期日 -->
                <div class="mt-4">
                    <h5>
                        <x-text.custom-input-label text="車検満期日をご入力ください。" class="mb-2" option="必須" />
                    </h5>
                    <x-text-input id="inspection_due_date" type="text" name="inspection_due_date" :value="old('inspection_due_date', $appointment->inspection_due_date ?? '')"
                        class="datepicker block mt-1 w-full rounded-none" />
                    <x-text.custom-input-label text="（記入例：2022/10/30）" spanClass="font-normal text-xs text-gray-500 mt-1" />
                    <x-input-error :messages="$errors->get('inspection_due_date')" class="attention" />
                </div>

                <!-- 過去利用履歴 -->
                <div class="mt-4">
                    <h5>
                        <x-text.custom-input-label text="今回ご予約いただく店舗・作業は、過去にご利用がございますか？" class="mb-2" option="必須" />
                    </h5>
                    <div class="mt-4">
                        <x-radio name="past_service_history" value="A)この店舗・作業どちらも、初めて利用" label="A)この店舗・作業どちらも、初めて利用"
                            :checked="old('past_service_history', $appointment->past_service_history) === 'A)この店舗・作業どちらも、初めて利用'" :disabled="false" class="mt-2" />
                        <x-radio name="past_service_history" value="B)この作業は初めて利用 (店舗は過去利用した)"
                            label="B)この作業は初めて利用 (店舗は過去利用した)" :checked="old('past_service_history', $appointment->past_service_history) === 'B)この作業は初めて利用 (店舗は過去利用した)'" :disabled="false" class="mt-2" />
                        <x-radio name="past_service_history" value="C)この店舗・作業とも、以前に利用している" label="C)この店舗・作業とも、以前に利用している"
                            :checked="old('past_service_history', $appointment->past_service_history) === 'C)この店舗・作業とも、以前に利用している'" :disabled="false" class="mt-2" />
                        <x-radio name="past_service_history" value="D)この作業は、弊社の別の店舗で利用した" label="D)この作業は、弊社の別の店舗で利用した"
                            :checked="old('past_service_history', $appointment->past_service_history) === 'D)この作業は、弊社の別の店舗で利用した'" :disabled="false" class="mt-2" />
                        <x-text.custom-input-label text="※今回ご予約いただく「店舗」ならびに、ご予約いただく「作業」（車検・点検やオイル・タイヤ交換など）に対してお聞かせ下さい。"
                            spanClass="font-normal text-xs text-gray-500 mt-1" />
                        <x-input-error :messages="$errors->get('past_service_history')" class="attention" />
                    </div>
                </div>
                <div class="flex flex-row items-center justify-center gap-4 mt-8">
                    <div class="w-1/3">
                        <button id="button-prev" class="bg-gray-200 text-black rounded w-full px-4 py-4" type="button" onclick="window.history.back()">
                            前の画面に戻る
                        </button>
                    </div>

                    <div class="w-1/3 block">
                        <button id="button-next" class="bg-red-1000 text-white rounded w-full px-4 py-4" type="submit">
                            確認画面へ
                        </button>
                    </div>

                    <div class="w-1/3 block">
                    <button id="button-cancel"
                                 class="bg-red-1000 text-white rounded w-full px-4 py-4" type="button" data-appointment-id="{{ $appointment->id }}">
                            キャンセル
                    </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('styles')
    @endsection
    @push('scripts')
        @vite(['resources/js/modules/appointments/index.js'])
    @endpush
</x-app-layout>
