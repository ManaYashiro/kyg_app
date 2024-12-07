<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-20">
            <div class="bg-white overflow-hidden shadow-sm ">
                <div class="p-6 text-gray-900">
                    <h3 class="mb-4">確認事項</h3>
                    @if ($errors->any())
                    <div id="error-message" class="box-attention">
                        <strong>内容に不足または誤りがあります。</strong><br>
                        入力項目の赤字部分を確認してください。
                    </div>
                    @endif
                    <p>以下の項目をご入力ください。</p>
                    <!-- フォーム開始 -->
                    <form method="POST" action="{{ route('appointments.confirm') }}">
                        @csrf <!-- CSRFトークンの追加 -->

                        <!-- 予約日時 -->
                        <div class="mt-4">
                            <h5>
                            <span class="form_required">必須</span>
                            <x-input-label class="h5text" for="vehicle" value="【車両選択】複数お車をご登録されている方は、何台目に登録されているお車か選択してください。" />
                            </h5>
                            <x-select id="vehicle" class="block mt-1 w-[120px] h-[38px] rounded-none" name="vehicle">
                                <option value="" {{ old('vehicle') == '' ? 'selected' : '' }}>
                                </option>
                                <option value="1台目" {{ old('vehicle') == '1台目' ? 'selected' : '' }}>
                                    1台目
                                </option>
                                <option value="2台目" {{ old('vehicle') == '2台目' ? 'selected' : '' }}>
                                    2台目
                                </option>
                                <option value="3台目" {{ old('vehicle') == '3台目' ? 'selected' : '' }}>
                                    3台目</option>
                                <option value="未登録の車" {{ old('vehicle') == '未登録の車' ? 'selected' : '' }}>
                                    未登録の車
                                </option>
                            </x-select>
                            <p class="caption">未登録車の場合は、次ページのメッセージ欄に車名・ナンバーをご入力ください。</p>
                            <x-input-error :messages="$errors->get('vehicle')" class="attention" />
                        </div>

                        <!-- 追加装備 -->
                        <div class="mt-4">
                            <h5>
                            <span class="form_any">任意</span>
                            <x-input-label class="h5text" or="additional_services" value="【追加整備】本作業とあわせて追加作業を依頼したい場合にお選びください。" />
                            </h5>
                            <x-checkbox name="additional_services[]" value="エンジンオイル交換"
                                label="エンジンオイル交換"
                                :checked="in_array('エンジンオイル交換', old('additional_services', []))"
                                :disabled="false" class="mt-2" />

                            <x-checkbox name="additional_services[]" value="タイヤローテション[前⇔後]"
                                label="タイヤローテション[前⇔後]"
                                :checked="in_array('タイヤローテション[前⇔後]', old('additional_services', []))"
                                :disabled="false" class="mt-2" />

                            <x-checkbox name="additional_services[]" value="タイヤ付替[夏⇔冬シーズンチェンジ]"
                                label="タイヤ付替[夏⇔冬シーズンチェンジ]"
                                :checked="in_array('タイヤ付替[夏⇔冬シーズンチェンジ]', old('additional_services', []))"
                                :disabled="false" class="mt-2" />
                        </div>

                        <!-- 車検満期日 -->
                        <div class="mt-4">
                            <h5>
                            <span class="form_required">必須</span>
                            <x-input-label class="h5text" for="inspection_due_date" value="車検満期日をご入力ください。" />
                            </h5>
                            <x-text-input id="inspection_due_date" class="block mt-1 w-full rounded-none" type="date"
                                name='inspection_due_date' />
                            <p class="caption">（記入例：2022/10/30）</p>
                            <x-input-error :messages="$errors->get('inspection_due_date')" class="attention" />
                        </div>

                        <!-- 過去利用履歴 -->
                        <div class="mt-4">
                            <h5>
                            <span class="form_required">必須</span>
                            <x-input-label class="h5text" for="past_service_history" value="今回ご予約いただく店舗・作業は、過去にご利用がございますか？" />
                            </h5>
                            <div class="mt-4">
                            <x-radio name="past_service_history" value="A)この店舗・作業どちらも、初めて利用" label="A)この店舗・作業どちらも、初めて利用"
                                :checked="old('past_service_history') === 'A)この店舗・作業どちらも、初めて利用'" :disabled="false" class="mt-2" />
                            <x-radio name="past_service_history" value="B)この作業は初めて利用 (店舗は過去利用した)"
                                label="B)この作業は初めて利用 (店舗は過去利用した)" :checked="old('past_service_history') === 'B)この作業は初めて利用 (店舗は過去利用した)'" :disabled="false" class="mt-2" />
                            <x-radio name="past_service_history" value="C)この店舗・作業とも、以前に利用している" label="C)この店舗・作業とも、以前に利用している"
                                :checked="old('past_service_history') === 'C)この店舗・作業とも、以前に利用している'" :disabled="false" class="mt-2" />
                            <x-radio name="past_service_history" value="D)この作業は、弊社の別の店舗で利用した" label="D)この作業は、弊社の別の店舗で利用した"
                                :checked="old('past_service_history') === 'D)この作業は、弊社の別の店舗で利用した'" :disabled="false" class="mt-2" />
                            <p class="caption">※今回ご予約いただく「店舗」ならびに、ご予約いただく「作業」（車検・点検やオイル・タイヤ交換など）に対してお聞かせ下さい。</p>
                            <x-input-error :messages="$errors->get('past_service_history')" class="attention" />
                            </div>
                        </div>
                        <div class="btn-area1">
                            <x-primary-button class="ml-4" type="submit">
                                {{ __('前戻る') }}
                            </x-primary-button>
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
