<x-app-layout>
    <div class="pt-[1.5rem] pb-[3rem]">
        <div class="bg-white overflow-hidden">
            <div class="pt-0 pr-6 pb-6 pl-6 text-gray-900">
                <x-text.custom-text text="確認事項" class="mb-3 bottom-border-text font-bold" />
                @if ($errors->any())
                    <div id="error-message" class="box-attention">
                        <strong>内容に不足または誤りがあります。</strong><br>
                        入力項目の赤字部分を確認してください。
                    </div>
                @endif
                <p>以下の項目をご入力ください。</p>
                <!-- フォーム開始 -->
                <form id="reservation-submit--form" method="POST" action="{{ route('appointments.confirm') }}">
                    <!-- 予約日時 -->
                    <div class="mt-4">
                        <h5>
                            <x-text.custom-input-label text="【車両選択】複数お車をご登録されている方は、何台目に登録されているお車か選択してください。"
                                class="mb-2" option="必須" />
                        </h5>
                        @php
                            $user_vehicle_id = $processData['user_vehicle_id'] ?? null;
                        @endphp
                        <x-select id="user_vehicle_id" class="block mt-1 w-[130px] h-[38px] rounded-none"
                            name="user_vehicle_id" required>
                            <option value=""
                                {{ (old('user_vehicle_id') ?? $user_vehicle_id) == '' ? 'selected' : '' }}>
                            </option>
                            @for ($i = 1; $i <= 3; $i++)
                                <option value="{{ $i }}"
                                    {{ (old('user_vehicle_id') ?? $user_vehicle_id) == $i ? 'selected' : '' }}>
                                    {{ $i }}台目
                                </option>
                            @endfor
                            <option value="4"
                                {{ (old('user_vehicle_id') ?? $user_vehicle_id) == '4' ? 'selected' : '' }}>
                                未登録の車
                            </option>
                        </x-select>
                        <x-text.custom-input-label text="未登録車の場合は、次ページのメッセージ欄に車名・ナンバーをご入力ください。"
                            spanClass="font-normal text-xs text-gray-500 mt-1" />
                        <x-ajax-input-error id="error-user_vehicle_id" class="mt-2" />
                        <x-input-error :messages="$errors->get('user_vehicle_id')" class="attention" />
                    </div>

                    <!-- 追加整備 -->
                    <div class="mt-4">
                        <h5>
                            <x-text.custom-input-label text="【追加整備】本作業とあわせて追加作業を依頼したい場合にお選びください。" class="mb-2"
                                option="任意" />
                        </h5>
                        @php
                            $additional_services = $processData['additional_services'] ?? [];
                        @endphp
                        <x-checkbox id="reservation-checkbox-1" name="additional_services[]" value="エンジンオイル交換"
                            label="エンジンオイル交換" :checked="in_array('エンジンオイル交換', old('additional_services', $additional_services))" :disabled="false" />
                        <x-checkbox id="reservation-checkbox-2" name="additional_services[]" value="タイヤローテション[前⇔後]"
                            label="タイヤローテション[前⇔後]" :checked="in_array(
                                'タイヤローテション[前⇔後]',
                                old('additional_services', $additional_services),
                            )" :disabled="false" />
                        <x-checkbox id="reservation-checkbox-3" name="additional_services[]" value="タイヤ付替[夏⇔冬シーズンチェンジ]"
                            label="タイヤ付替[夏⇔冬シーズンチェンジ]" :checked="in_array(
                                'タイヤ付替[夏⇔冬シーズンチェンジ]',
                                old('additional_services', $additional_services),
                            )" :disabled="false" />
                        <x-ajax-input-error id="error-additional_services" class="mt-2" />
                    </div>
                    <!-- 車検満期日 -->
                    <div class="mt-4">
                        <h5>
                            <x-text.custom-input-label text="車検満期日をご入力ください。" class="mb-2" option="必須" />
                        </h5>
                        @php
                            $inspection_due_date = $processData['inspection_due_date'] ?? null;
                        @endphp
                        <x-text-data-input id="inspection_due_date" type="text" name="inspection_due_date"
                            :value="old('inspection_due_date') ?? $inspection_due_date" class="datepicker block mt-1 w-full rounded-none" required />
                        <x-text.custom-input-label text="（記入例：2022/10/30）"
                            spanClass="font-normal text-xs text-gray-500 mt-1" />
                        <x-ajax-input-error id="error-inspection_due_date" class="mt-2" />
                        <x-input-error :messages="$errors->get('inspection_due_date')" class="attention" />
                    </div>
                    <!-- 過去利用履歴 -->
                    <div class="mt-4">
                        <h5>
                            <x-text.custom-input-label text="今回ご予約いただく店舗・作業は、過去にご利用がございますか？" class="mb-2"
                                option="必須" />
                        </h5>
                        <div class="mt-4">
                            @php
                                $past_service_history = $processData['past_service_history'] ?? [];
                            @endphp
                            <x-radio id="reservation-radio-1" name="past_service_history" value="A)この店舗・作業どちらも、初めて利用"
                                label="A)この店舗・作業どちらも、初めて利用" :checked="(old('past_service_history', $past_service_history)) === 'A)この店舗・作業どちらも、初めて利用'" :disabled="false" required />
                            <x-radio id="reservation-radio-2" name="past_service_history"
                                value="B)この作業は初めて利用 (店舗は過去利用した)" label="B)この作業は初めて利用 (店舗は過去利用した)" :checked="(old('past_service_history', $past_service_history)) === 'B)この作業は初めて利用 (店舗は過去利用した)'"
                                :disabled="false" required />
                            <x-radio id="reservation-radio-3" name="past_service_history" value="C)この店舗・作業とも、以前に利用している"
                                label="C)この店舗・作業とも、以前に利用している" :checked="(old('past_service_history', $past_service_history)) === 'C)この店舗・作業とも、以前に利用している'" :disabled="false" required />
                            <x-radio id="reservation-radio-4" name="past_service_history" value="D)この作業は、弊社の別の店舗で利用した"
                                label="D)この作業は、弊社の別の店舗で利用した" :checked="(old('past_service_history', $past_service_history)) === 'D)この作業は、弊社の別の店舗で利用した'" :disabled="false" required />
                            <x-text.custom-input-label
                                text="※今回ご予約いただく「店舗」ならびに、ご予約いただく「作業」（車検・点検やオイル・タイヤ交換など）に対してお聞かせ下さい。"
                                spanClass="font-normal text-xs text-gray-500 mt-1" />
                            <x-input-error :messages="$errors->get('past_service_history')" class="attention" />
                            <x-ajax-input-error id="error-past_service_history" class="mt-2" />
                        </div>
                    </div>
                    <div class="btn-area1">
                        <input type="button" class="ml-4 btn-type1" value="前の画面に戻る"
                            onclick="window.location.href='{{ route('top') }}'">
                        <input class="ml-4 btn-type2" type="submit" value="次へ進む">
                    </div>
                </form>
                <!-- フォーム終了 -->
            </div>
        </div>
    </div>
    @section('styles')
        @vite(['resources/css/modules/reservation/confirmationitems.css'])
    @endsection
    @push('scripts')
        @vite(['resources/js/modules/reservation/confirmationitems.js'])
    @endpush
</x-app-layout>
