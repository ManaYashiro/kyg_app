<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-[1.5rem] pb-[3rem]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-[10rem]">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-6 text-gray-900">
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
                            <p></p>
                        </div>
                        <!-- 時間 -->
                        <div class="mt-4">
                            <x-text.custom-input-label text="時間" class="mb-2 left-border-text" />
                            <p></p>
                        </div>
                        <!-- ご希望の店舗 -->
                        <div class="mt-4">
                            <x-text.custom-input-label text="ご希望の店舗" class="mb-2 left-border-text" />
                            <p></p>
                        </div>
                        <!-- 作業カテゴリ -->
                        <div class="mt-4">
                            <x-text.custom-input-label text="作業カテゴリ" class="mb-2 left-border-text" />
                            <p></p>
                        </div>
                        <!-- 予約する作業 -->
                        <div class="mt-4">
                            <x-text.custom-input-label text="予約する作業" class="mb-2 left-border-text" />
                            <p></p>
                        </div>
                        <div class="mt-6">
                            <x-text.custom-text text="確認事項" class="mt-6 mb-2 bg-gray-text" />
                        </div>
                        <!-- 予約日時 -->
                        <div class="mt-4">
                            <h5 class="">【車両選択】複数お車をご登録されている方は、何台目に登録されているお車か選択してください。</h5>
                            <x-text.custom-input-label text="予約日" class="mb-2 left-border-text" />
                            <p>{{ $finalcheck['vehicle'] }}</p>
                            <input type="hidden" name="vehicle" value="{{ $finalcheck['vehicle'] }}">
                        </div>
                        <!-- 追加整備 -->
                        <div class="mt-4">
                            <h5 class="">【追加整備】本作業とあわせて追加作業を依頼したい場合にお選びください。</h5>
                            <x-text.custom-input-label text="予約日" class="mb-2 left-border-text" />
                            @foreach ($finalcheck['additional_services'] as $service)
                            <p>{{ $service }}</p>
                            @endforeach
                            <input type="hidden" name="vehicle" value="{{ implode(', ', $finalcheck['additional_services']) }}">
                        </div>
                        <!-- 車検満期日 -->
                        <div class="mt-4">
                            <x-text.custom-input-label text="車検満期日をご入力ください。" class="mb-2 left-border-text" />
                            <p>{{ $finalcheck['inspection_due_date'] }}</p>
                            <input type="hidden" name="vehicle" value="{{ $finalcheck['inspection_due_date'] }}">
                        </div>
                        <!-- 過去利用履歴 -->
                        <div class="mt-4">
                            <h5 class="">今回ご予約いただく店舗・作業は、過去にご利用がございますか？</h5>
                            <p>{{ $finalcheck['past_service_history'] }}</p>
                            <input type="hidden" name="vehicle" value="{{ $finalcheck['past_service_history'] }}">
                        </div>
                        <!-- 予約者情報 -->
                        <div class="mt-4">
                            <x-text.custom-text text="予約者情報" class="mt-4 mb-2 bg-gray-text" />
                        </div>
                        <!-- 顧客名 -->
                        <div class="mt-4">
                            <h5 class="">顧客名</h5>
                            <p>{{ $finalcheck['user']['name'] }}</p>
                        </div>
                        <!-- フリガナ -->
                        <div class="mt-4">
                            <h5 class="">フリガナ</h5>
                            <p>{{ $finalcheck['user']['name_furigana'] }}</p>
                        </div>
                        <!-- 生年月日 -->
                        <div class="mt-4">
                            <h5 class="">生年月日</h5>
                            <p>{{ $finalcheck['user']['birthday'] }}</p>
                        </div>
                        <!-- 性別 -->
                        <div class="mt-4">
                            <h5 class="">性別</h5>
                            <p>{{ $finalcheck['user']['gender'] }}</p>
                        </div>
                        <!-- 電話番号 -->
                        <div class="mt-4">
                            <h5 class="">電話番号</h5>
                            <p>{{ $finalcheck['user']['phone_number'] }}</p>
                        </div>
                        <!-- 電話連絡の希望時間帯 -->
                        <div class="mt-4">
                            <h5 class="">電話連絡の希望時間帯</h5>
                            <p>{{ $finalcheck['user']['call_time'] }}</p>
                        </div>
                        <!-- 郵便番号 -->
                        <div class="mt-4">
                            <h5 class="">郵便番号</h5>
                            <p>{{ $finalcheck['user']['zipcode'] }}</p>
                        </div>
                        <!-- 都道府県 -->
                        <div class="mt-4">
                            <h5 class="">都道府県</h5>
                            <p>{{ $finalcheck['user']['prefecture'] }}</p>
                        </div>
                        <!-- 市町村番地 -->
                        <div class="mt-4">
                            <h5 class="">市町村番地</h5>
                            <p>{{ $finalcheck['user']['address1'] }}</p>
                        </div>
                        <!-- 建物名など -->
                        @if(!empty($finalcheck['user']['address2']))
                        <div class="mt-4">
                            <h5 class="">建物名など</h5>
                            <p>{{ $finalcheck['user']['address2'] }}</p>
                        </div>
                        @endif
                        <!-- 車名(1台目) -->
                        <div class="mt-4">
                            <h5 class="">車名(1台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car1_name'] }}</p>
                        </div>
                        <!-- 型式(1台目) -->
                        @if(!empty($finalcheck['vehicles']['car1_katashiki']))
                        <div class="mt-4">
                            <h5 class="">型式(1台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car1_katashiki'] }}</p>
                        </div>
                        @endif
                        <!-- ナンバー(1台目) -->
                        <div class="mt-4">
                            <h5 class="">ナンバー(1台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car1_number'] }}</p>
                        </div>
                        <!-- 車種区分(1台目) -->
                        @if(!empty($finalcheck['vehicles']['car1_class']))
                        <div class="mt-4">
                            <h5 class="">車種区分(1台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car1_class'] }}</p>
                        </div>
                        @endif
                        <!-- 車名(2台目) -->
                        @if(!empty($finalcheck['vehicles']['car2_class']))
                        <div class="mt-4">
                            <h5 class="">車名(2台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car2_name'] }}</p>
                        </div>
                        @endif
                        <!-- 型式(2台目) -->
                        @if(!empty($finalcheck['vehicles']['car2_class']))
                        <div class="mt-4">
                            <h5 class="">型式(2台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car2_katashiki'] }}</p>
                        </div>
                        @endif
                        <!-- ナンバー(2台目) -->
                        @if(!empty($finalcheck['vehicles']['car2_class']))
                        <div class="mt-4">
                            <h5 class="">ナンバー(2台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car2_number'] }}</p>
                        </div>
                        @endif
                        <!-- 車種区分(2台目) -->
                        @if(!empty($finalcheck['vehicles']['car2_class']))
                        <div class="mt-4">
                            <h5 class="">車種区分(2台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car2_class'] }}</p>
                        </div>
                        @endif
                        <!-- 車名(3台目) -->
                        @if(!empty($finalcheck['vehicles']['car3_class']))
                        <div class="mt-4">
                            <h5 class="">車名(3台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car3_name'] }}</p>
                        </div>
                        @endif
                        <!-- 型式(3台目) -->
                        @if(!empty($finalcheck['vehicles']['car3_class']))
                        <div class="mt-4">
                            <h5 class="">型式(3台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car3_katashiki'] }}</p>
                        </div>
                        @endif
                        <!-- ナンバー(3台目) -->
                        @if(!empty($finalcheck['vehicles']['car3_class']))
                        <div class="mt-4">
                            <h5 class="">ナンバー(3台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car3_number'] }}</p>
                        </div>
                        @endif
                        <!-- 車種区分(3台目) -->
                        @if(!empty($finalcheck['vehicles']['car3_class']))
                        <div class="mt-4">
                            <h5 class="">車種区分(3台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car3_class'] }}</p>
                        </div>
                        @endif
                        <!-- メルマガ -->
                        @if(!empty($finalcheck['user']['is_receive_newsletter']))
                        <div class="mt-4">
                            <h5 class="">メルマガ配信</h5>
                            <p>{{ $finalcheck['user']['is_receive_newsletter'] }}</p>
                        </div>
                        @endif
                        <!-- アンケート -->
                        <div class="mt-4">
                            <h5 class="">[アンケート]弊社の車検を何でお知りになりましたか？(複数回答3つまで)</h5>
                            <ul>
                                @foreach ($anket as $answerId)
                                    <li>{{ $anketnames[$answerId] }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- 担当者 -->
                        @if(!empty($finalcheck['user']['manager']))
                        <div class="mt-4">
                            <h5 class="">担当者</h5>
                            <p>{{ $finalcheck['user']['manager'] }}</p>
                        </div>
                        @endif
                        <!-- 部署名／支店名 -->
                        @if(!empty($finalcheck['user']['department']))
                        <div class="mt-4">
                            <h5 class="">部署名／支店名</h5>
                            <p>{{ $finalcheck['user']['department'] }}</p>
                        </div>
                        @endif
                        <!-- 予約についてのご要望などメッセージ -->
                        <div class="mt-4">
                            <x-text.custom-text text="予約についてのご要望などメッセージがございましたらご記入ください" class="mt-6 mb-2 bg-gray-text" />
                        </div>
                        <textarea name="" cols rows="7" class="w100" style="width: 571px; height: 121px;"></textarea>
                        <!-- 確定ボタン -->
                        <div class="btn-area1">
                            <input type="button" class="ml-4 btn-type1" value="前の画面に戻る" onclick="window.location.href='{{ route('confirmationItems.index') }}'">
                            <input class="ml-4 btn-type2" type="submit" value="完了する">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
