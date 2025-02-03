<x-app-layout>
    <div class="pt-[1.5rem] pb-[3rem]">
        <div class="bg-white overflow-hidden">
            <div class="attention-not-done-wrapper">
                <div id="error-message" class="attention-not-done">
                    <span>まだ手続きは完了しておりません。</span><br>
                    内容をご確認いただき、「完了する」ボタンを押してください。
                </div>
            </div>
            <x-text.custom-text text="最終内容確認" class="mb-3 bottom-border-text font-bold" />
            <p>ご予約内容をご確認ください。<br>以下の内容でよろしければ画面下の【完了する】ボタンをクリックしてください。</p>
            <form method="POST" action="{{ route('confirmationItems.store') }}">
                @csrf
                <div class="mt-4">
                    <x-text.custom-text text="予約内容" class="mt-6 mb-2 bg-gray-text" />
                </div>
                <!-- 予約日 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="予約日" class="mb-2 left-border-text" />
                    <label>{{ \Carbon\Carbon::parse($finalcheck['reservation']['appointmentDateTime'])->format('Y/m/d') }}</label>
                    <input type="hidden" name="appointmentDateTime"
                        value="{{ \Carbon\Carbon::parse($finalcheck['reservation']['appointmentDateTime'])->format('Y/m/d H:i') }}">
                </div>
                <!-- 時間 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="時間" class="mb-2 left-border-text" />
                    <label>{{ \Carbon\Carbon::parse($finalcheck['reservation']['appointmentDateTime'])->format('H:i') }}</label>
                </div>
                <!-- ご希望の店舗 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="ご希望の店舗" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['reservation']['store'] }}</label>
                    <input type="hidden" name="store" value="{{ $finalcheck['reservation']['store'] }}">
                </div>
                <!-- 作業カテゴリ -->
                <div class="mt-4">
                    <x-text.custom-input-label text="作業カテゴリ" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['reservation']['inspection_type'] }}</label>
                    <input type="hidden" name="inspection_type"
                        value="{{ $finalcheck['reservation']['inspection_type'] }}">
                </div>
                <!-- 作業種別 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="作業種別" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['reservation']['work_type'] }}</label>
                    <input type="hidden" name="work_type" value="{{ $finalcheck['reservation']['work_type'] }}">
                </div>
                <!-- 個人・法人 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="個人・法人" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['reservation']['customer_type'] }}</label>
                    <input type="hidden" name="customer_type"
                        value="{{ $finalcheck['reservation']['customer_type'] }}">
                </div>
                <!-- 予約する作業 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="予約する作業" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['reservation']['reservation_name'] }}</label>
                    <input type="hidden" name="reservation_task_id"
                        value="{{ $finalcheck['reservation']['reservation_task_id'] }}">
                </div>
                <div class="mt-4">
                    <x-text.custom-text text="確認事項" class="mt-6 mb-2 bg-gray-text" />
                </div>
                <!-- 車両選択 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="【車両選択】複数お車をご登録されている方は、何台目に登録されているお車か選択してください。"
                        class="mb-2 left-border-text" />
                    <label>
                        @if ($finalcheck['user_vehicle_id'] == 4)
                            未登録の車
                        @else
                            {{ $finalcheck['user_vehicle_id'] }}台目
                        @endif
                    </label>
                    <input type="hidden" name="user_vehicle_id" value="{{ $finalcheck['user_vehicle_id'] }}">
                </div>
                <!-- 追加整備 -->
                @if (!empty($finalcheck['additional_services']))
                    <div class="mt-4">
                        <x-text.custom-input-label text="【追加整備】本作業とあわせて追加作業を依頼したい場合にお選びください。"
                            class="mb-2 left-border-text" />
                        @foreach ($finalcheck['additional_services'] as $service)
                            <label>{{ $service }}</label><br>
                        @endforeach
                        <input type="hidden" name="additional_services"
                            value="{{ implode(', ', $finalcheck['additional_services']) }}">
                    </div>
                @endif
                <!-- 車検満期日 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="車検満期日をご入力ください。" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['inspection_due_date'] }}</label>
                    <input type="hidden" name="inspection_due_date" value="{{ $finalcheck['inspection_due_date'] }}">
                </div>
                <!-- 過去利用履歴 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="今回ご予約いただく店舗・作業は、過去にご利用がございますか？" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['past_service_history'] }}</label>
                    <input type="hidden" name="past_service_history"
                        value="{{ $finalcheck['past_service_history'] }}">
                </div>
                <!-- 予約者情報 -->
                <div class="mt-4">
                    <x-text.custom-text text="予約者情報" class="mt-4 mb-2 bg-gray-text" />
                </div>
                <!-- 顧客名 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="顧客名" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['user']['name'] }}</label>
                    <input type="hidden" name="user" value="{{ $finalcheck['user']['name'] }}">
                </div>
                <!-- フリガナ -->
                <div class="mt-4">
                    <x-text.custom-input-label text="フリガナ" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['user']['name_furigana'] }}</label>
                </div>
                <!-- 生年月日 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="生年月日" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['user']['birthday'] }}</label>
                </div>
                <!-- 性別 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="性別" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['user']['gender'] }}</label>
                </div>
                <!-- メールアドレス -->
                <div class="mt-4">
                    <x-text.custom-input-label text="メールアドレス" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['user']['email'] }}</label>
                </div>
                <!-- 電話番号 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="電話番号" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['user']['phone_number'] }}</label>
                </div>
                <!-- 電話連絡の希望時間帯 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="電話連絡の希望時間帯" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['user']['call_time'] }}</label>
                </div>
                <!-- 郵便番号 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="郵便番号" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['user']['zipcode'] }}</label>
                </div>
                <!-- 都道府県 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="都道府県" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['user']['prefecture'] }}</label>
                </div>
                <!-- 市町村番地 -->
                <div class="mt-4">
                    <x-text.custom-input-label text="市町村番地" class="mb-2 left-border-text" />
                    <label>{{ $finalcheck['user']['address1'] }}</label>
                </div>
                <!-- 建物名など -->
                @if (!empty($finalcheck['user']['address2']))
                    <div class="mt-4">
                        <x-text.custom-input-label text="建物名など" class="mb-2 left-border-text" />
                        <label>{{ $finalcheck['user']['address2'] }}</label>
                    </div>
                @endif

                <!-- 車両 -->
                @foreach ($finalcheck['vehicles'] as $index => $vehicle)
                    <!-- 車名 -->
                    @if (!empty($vehicle['car_name']))
                        <div class="mt-4">
                            <x-text.custom-input-label text="車名({{ $index + 1 }}台目)"
                                class="mb-2 left-border-text" />
                            <label>{{ $vehicle['car_name'] }}</label>
                        </div>
                    @endif

                    <!-- 型式 -->
                    @if (!empty($vehicle['car_katashiki']))
                        <div class="mt-4">
                            <x-text.custom-input-label text="型式({{ $index + 1 }}台目)"
                                class="mb-2 left-border-text" />
                            <label>{{ $vehicle['car_katashiki'] }}</label>
                        </div>
                    @endif

                    <!-- ナンバー -->
                    @if (!empty($vehicle['transport_branch']))
                        <div class="mt-4">
                            <x-text.custom-input-label text="ナンバー({{ $index + 1 }}台目)"
                                class="mb-2 left-border-text" />
                            <label>{{ $vehicle['transport_branch'] }} {{ $vehicle['classification_no'] }} {{ $vehicle['kana'] }} {{ $vehicle['serial_no'] }}</label>
                        </div>
                    @endif

                    <!-- 車種区分 -->
                    @if (!empty($vehicle['car_class']))
                        <div class="mt-4">
                            <x-text.custom-input-label text="車種区分({{ $index + 1 }}台目)"
                                class="mb-2 left-border-text" />
                            <label>{{ $vehicle['car_class'] }}</label>
                        </div>
                    @endif
                @endforeach

                <!-- メルマガ -->
                @if (!empty($finalcheck['user']['is_receive_newsletter']))
                    <div class="mt-4">
                        <x-text.custom-input-label text="メルマガ配信" class="mb-2 left-border-text" />
                        <label>{{ $finalcheck['user']['is_receive_newsletter'] }}</label>
                    </div>
                @endif
                <!-- アンケート -->
                <div class="mt-4">
                    <x-text.custom-input-label text="[アンケート]弊社の車検を何でお知りになりましたか？(複数回答3つまで)"
                        class="mb-2 left-border-text" />
                    @foreach ($finalcheck['user']['questionnaire'] ?? [] as $questionnaires)
                        <label>{{ $questionnaires }}</label><br>
                    @endforeach
                </div>
                <!-- 担当者 -->
                @if (!empty($finalcheck['user']['manager']))
                    <div class="mt-4">
                        <x-text.custom-input-label text="担当者" class="mb-2 left-border-text" />
                        <label>{{ $finalcheck['user']['manager'] }}</label>
                    </div>
                @endif
                <!-- 部署名／支店名 -->
                @if (!empty($finalcheck['user']['department']))
                    <div class="mt-4">
                        <x-text.custom-input-label text="部署名／支店名" class="mb-2 left-border-text" />
                        <label>{{ $finalcheck['user']['department'] }}</label>
                    </div>
                @endif
                <!-- 予約についてのご要望などメッセージ -->
                <div class="box-type1 ns">
                    <x-text.custom-text text="予約についてのご要望などメッセージがございましたらご記入ください" class="mt-6 mb-2 bg-gray-text" />
                </div>
                <textarea id='remarks' name="remarks" cols rows="7" class="w100" style="width: 809px; height: 158px;"></textarea>
                <!-- 確定ボタン -->
                <div class="btn-area1">
                    <input type="button" id="btn" class="ml-4 btn-type1" value="前の画面に戻る"
                        onclick="window.history.back()">
                    {{-- onclick="location.href='{{ url()->previous() }}'"> --}}
                    <input class="ml-4 btn-type2" type="submit" value="完了する">
                </div>
            </form>
        </div>
    </div>
    @section('styles')
        @vite(['resources/css/modules/reservation/confirmationitems.css'])
    @endsection
    @push('scripts')
        @vite(['resources/js/modules/reservation/confirmationitems.js'])
    @endpush
</x-app-layout>
