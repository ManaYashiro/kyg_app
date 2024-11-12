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
                    <!-- フォーム開始 -->
                    <form method="POST" action="{{ route('appointments.store') }}">
                        @csrf <!-- CSRFトークンの追加 -->
                        <div class="mt-4">
                            <x-input-label for="vehicle_name" value="車検予約" />
                            <x-input-label for="reservation_datetime" value="予約日時" />
                            <x-text-input id="reservation_datetime" class="block mt-1 w-full" name='reservation_datetime'/>
                        </div>
                        @for ($i = 0; $i < 2; $i++)
                            <div class="mt-4">
                                <x-input-label for="vehicle_name_{{ $i }}" value="車両名" />
                                <x-text-input id="vehicle_name_{{ $i }}" class="block mt-1 w-full" name="vehicle_name[]"
                                            :value="old('vehicle_name.' . $i)" />
                                <x-input-error :messages="$errors->get('vehicle_name.'.$i)" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="registration_number_{{ $i }}" value="車両番号登録" />
                                <x-text-input id="registration_number_{{ $i }}" class="block mt-1 w-full" name="registration_number[]"
                                            :value="old('registration_number.' . $i)" />
                                <x-input-error :messages="$errors->get('registration_number.'.$i)" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="vehicle_type_{{ $i }}" value="車両タイプ" />
                                <x-select id="vehicle_type_{{ $i }}" class="block mt-1 w-full" name="vehicle_type[]"
                                        :options="[
                                            '' => '選択して下さい',
                                            '1' => 'セダン',
                                            '2' => 'SUV',
                                            '3' => 'ワゴン',
                                            '4' => 'トラック',
                                            '5' => 'その他',
                                        ]" />
                                <x-input-error :messages="$errors->get('vehicle_type.'.$i)" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="license_plate_{{ $i }}" value="ナンバープレート" />
                                <x-text-input id="license_plate_{{ $i }}" class="block mt-1 w-full" name="license_plate[]"
                                            :value="old('license_plate.' . $i)" />
                                <x-input-error :messages="$errors->get('license_plate.'.$i)" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="inspection_due_date_{{ $i }}" value="車両満了日" />
                                <x-text-input id="inspection_due_date_{{ $i }}" class="block mt-1 w-full" type="date" name="inspection_due_date[]"
                                            :value="old('inspection_due_date.' . $i)" />
                                <x-input-error :messages="$errors->get('inspection_due_date.'.$i)" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="additional_services_{{ $i }}" value="追加装備" />
                                <x-checkbox name="additional_services[{{ $i }}][]" value="エンジンオイル交換" label="エンジンオイル交換" :checked="old('additional_services.' . $i, false)" :disabled="false" class="mt-2" />
                                <x-checkbox name="additional_services[{{ $i }}][]" value="タイヤローテション[前⇔後]" label="タイヤローテション[前⇔後]" :checked="old('additional_services.' . $i, false)" :disabled="false" class="mt-2" />
                                <x-checkbox name="additional_services[{{ $i }}][]" value="タイヤ付替[夏⇔冬シーズンチェンジ]" label="タイヤ付替[夏⇔冬シーズンチェンジ" :checked="old('additional_services.' . $i, false)" :disabled="false" class="mt-2" />
                            </div>
                        @endfor

                        {{-- <div class="mt-4">
                            <x-input-label for="vehicle_name" value="車検予約" />
                            <x-input-label for="reservation_datetime" value="予約日時" />
                            <x-text-input id="reservation_datetime" class="block mt-1 w-full" name='reservation_datetime'/>
                        </div>
                        <!-- 車両1台目 -->
                        <div class="mt-4">
                            <x-input-label for="vehicle_name" value="車両名" />
                            <x-text-input id="vehicle_name" class="block mt-1 w-full" name='vehicle_name'
                            :value="old('vehicle_name')"/>
                            <x-input-error :messages="$errors->get('vehicle_name')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="registration_number" value="車両番号登録" />
                            <x-text-input id="registration_number" class="block mt-1 w-full" name='registration_number'
                            :value="old('registration_number')"/>
                            <x-input-error :messages="$errors->get('registration_number')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="vehicle_type" value="車両タイプ" />
                            <x-select id="vehicle_type" class="block mt-1 w-full" name="vehicle_type"
                            :options="[
                                '' => '選択して下さい',
                                '1' => 'セダン',
                                '2' => 'SUV',
                                '3' => 'ワゴン',
                                '4' => 'トラック',
                                '5' => 'その他',
                            ]"/>
                            <x-input-error :messages="$errors->get('vehicle_type')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="license_plate" value="ナンバープレート" />
                            <x-text-input id="license_plate" class="block mt-1 w-full" name='license_plate'
                            :value="old('license_plate')"/>
                            <x-input-error :messages="$errors->get('license_plate')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="inspection_due_date" value="車両満了日" />
                            <x-text-input  id="inspection_due_date" class="block mt-1 w-full" type="date" name='inspection_due_date'
                            :value="old('inspection_due_date')"/>
                            <x-input-error :messages="$errors->get('inspection_due_date')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="additional_services" value="追加装備" />
                            <x-checkbox name="additional_services[]" value="エンジンオイル交換" label="エンジンオイル交換" :checked="old('additional_services', false)" :disabled="false" class="mt-2" />
                            <x-checkbox name="additional_services[]" value="タイヤローテション[前⇔後]" label="タイヤローテション[前⇔後]" :checked="old('additional_services', false)" :disabled="false" class="mt-2" />
                            <x-checkbox name="additional_services[]" value="タイヤ付替[夏⇔冬シーズンチェンジ]" label="タイヤ付替[夏⇔冬シーズンチェンジ]" :checked="old('additional_services', false)" :disabled="false" class="mt-2" />
                        </div> --}}

                        <!-- 過去利用履歴 -->
                        <div class="mt-4">
                            <x-input-label for="past_service_history" value="過去利用履歴の有無 " />
                            <x-radio name="past_service_history" value="この店舗・作業どちらも、初めて利用" label="この店舗・作業どちらも、初めて利用" :checked="old('past_service_history', false)" :disabled="false" class="mt-2" />
                            <x-radio name="past_service_history" value="この作業は初めて利用 (店舗は過去利用した)" label="この作業は初めて利用 (店舗は過去利用した)" :checked="old('past_service_history', false)" :disabled="false" class="mt-2" />
                            <x-radio name="past_service_history" value="この店舗・作業とも、以前に利用している" label="この店舗・作業とも、以前に利用している" :checked="old('past_service_history', false)" :disabled="false" class="mt-2" />
                            <x-radio name="past_service_history" value="この作業は、弊社の別の店舗で利用した" label="この作業は、弊社の別の店舗で利用した" :checked="old('past_service_history', false)" :disabled="false" class="mt-2" />
                            <x-input-error :messages="$errors->get('past_service_history')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="message" value="メッセージ" />
                            <textarea name="message" id="message"></textarea>
                        </div>

                        <!-- 登録ボタン -->
                        <div class="mt-6">
                            <x-primary-button class="ml-4">
                                予約
                            </x-primary-button>
                        </div>
                    </form>
                    <!-- フォーム終了 -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
