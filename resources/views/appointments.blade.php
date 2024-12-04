<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-semibold mb-4">車検予約</h2>

                    @if (session('success'))
                        <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- フォーム開始 -->
                    <form method="POST" action="{{ route('appointments.confirm') }}">
                        @csrf <!-- CSRFトークンの追加 -->

                        <!-- 予約日時 -->
                        <div class="mt-4">
                            <x-input-label for="reservation_datetime" value="予約日時" />
                            <x-text-input id="reservation_datetime" class="block mt-1 w-full"
                                name='reservation_datetime' />
                            <x-input-error :messages="$errors->get('reservation_datetime')" class="mt-2" />
                        </div>
                        @for ($i = 0; $i < 3; $i++)
                            <!-- 車両名 -->
                            <div class="mt-4">
                                <x-input-label for="vehicle_name_{{ $i }}" value="車両名" />
                                <x-text-input id="vehicle_name_{{ $i }}" class="block mt-1 w-full"
                                    name="vehicle_name[]" :value="old('vehicle_name.' . $i)" />
                                <x-input-error :messages="$errors->get('vehicle_name.' . $i)" class="mt-2" />
                            </div>

                            <!-- 車両番号登録 -->
                            <div class="mt-4">
                                <x-input-label for="registration_number_{{ $i }}" value="車両番号登録" />
                                <x-text-input id="registration_number_{{ $i }}" class="block mt-1 w-full"
                                    name="registration_number[]" :value="old('registration_number.' . $i)" />
                                <x-input-error :messages="$errors->get('registration_number.' . $i)" class="mt-2" />
                            </div>

                            <!-- 車両タイプ -->
                            <div class="mt-4">
                                <x-input-label for="vehicle_type_{{ $i }}" value="車両タイプ" />
                                <x-select id="vehicle_type_{{ $i }}" class="block mt-1 w-full"
                                    name="vehicle_type[]">
                                    <option value="" {{ old('vehicle_type.' . $i) == '' ? 'selected' : '' }}>
                                        選択してください</option>
                                    <option value="sedan"
                                        {{ old('vehicle_type.' . $i) == 'sedan' ? 'selected' : '' }}>
                                        セダン</option>
                                    <option value="suv" {{ old('vehicle_type.' . $i) == 'suv' ? 'selected' : '' }}>
                                        SUV
                                    </option>
                                    <option value="wagon"
                                        {{ old('vehicle_type.' . $i) == 'wagon' ? 'selected' : '' }}>
                                        ワゴン</option>
                                    <option value="track"
                                        {{ old('vehicle_type.' . $i) == 'track' ? 'selected' : '' }}>
                                        トラック</option>
                                    <option value="other"
                                        {{ old('vehicle_type.' . $i) == 'other' ? 'selected' : '' }}>
                                        その他</option>
                                </x-select>
                                <x-input-error :messages="$errors->get('vehicle_type.' . $i)" class="mt-2" />
                            </div>

                            <!-- 車両満了日 -->
                            <div class="mt-4">
                                <x-input-label for="inspection_due_date_{{ $i }}" value="車両満了日" />
                                <x-text-input id="inspection_due_date_{{ $i }}" class="block mt-1 w-full"
                                    type="date" name="inspection_due_date[]" :value="old('inspection_due_date.' . $i)" />
                                <x-input-error :messages="$errors->get('inspection_due_date.' . $i)" class="mt-2" />
                            </div>

                            <!-- 追加装備 -->
                            <div class="mt-4">
                                <x-input-label for="additional_services_{{ $i }}" value="追加装備" />
                                <x-checkbox name="additional_services[{{ $i }}][]" value="エンジンオイル交換"
                                    label="エンジンオイル交換" :checked="in_array('エンジンオイル交換', old('additional_services.' . $i, []))" :disabled="false" class="mt-2" />
                                <x-checkbox name="additional_services[{{ $i }}][]" value="タイヤローテション[前⇔後]"
                                    label="タイヤローテション[前⇔後]" :checked="in_array(
                                        'タイヤローテション[前⇔後]',
                                        old('additional_services.' . $i, []),
                                    )" :disabled="false" class="mt-2" />
                                <x-checkbox name="additional_services[{{ $i }}][]"
                                    value="タイヤ付替[夏⇔冬シーズンチェンジ]" label="タイヤ付替[夏⇔冬シーズンチェンジ" :checked="in_array(
                                        'タイヤ付替[夏⇔冬シーズンチェンジ]',
                                        old('additional_services.' . $i, []),
                                    )"
                                    :disabled="false" class="mt-2" />
                            </div>
                        @endfor

                        <!-- 過去利用履歴 -->
                        <div class="mt-4">
                            <x-input-label for="past_service_history" value="過去利用履歴の有無" />
                            <x-radio name="past_service_history" value="この店舗・作業どちらも、初めて利用" label="この店舗・作業どちらも、初めて利用"
                                :checked="old('past_service_history') === 'この店舗・作業どちらも、初めて利用'" :disabled="false" class="mt-2" />
                            <x-radio name="past_service_history" value="この作業は初めて利用 (店舗は過去利用した)"
                                label="この作業は初めて利用 (店舗は過去利用した)" :checked="old('past_service_history') === 'この作業は初めて利用 (店舗は過去利用した)'" :disabled="false" class="mt-2" />
                            <x-radio name="past_service_history" value="この店舗・作業とも、以前に利用している" label="この店舗・作業とも、以前に利用している"
                                :checked="old('past_service_history') === 'この店舗・作業とも、以前に利用している'" :disabled="false" class="mt-2" />
                            <x-radio name="past_service_history" value="この作業は、弊社の別の店舗で利用した" label="この作業は、弊社の別の店舗で利用した"
                                :checked="old('past_service_history') === 'この作業は、弊社の別の店舗で利用した'" :disabled="false" class="mt-2" />
                            <x-input-error :messages="$errors->get('past_service_history')" class="mt-2" />
                        </div>

                        <!-- メッセージ -->
                        <div class="mt-4">
                            <x-input-label for="message" value="メッセージ" />
                            <textarea name="message" id="message" class="block mt-1 w-full border-gray-300 rounded-md"></textarea>
                        </div>

                        <div class="mt-4">
                            <x-primary-button class="ml-4" type="submit">
                                {{ __('確認画面へ') }}
                            </x-primary-button>
                        </div>
                    </form>
                    <!-- フォーム終了 -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
