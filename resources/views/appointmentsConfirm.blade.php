<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-6 text-gray-900">
                    <div id="error-message" class="box-attention">
                        <strong>まだ手続きは完了しておりません。</strong><br>
                        内容をご確認いただき、「完了する」ボタンを押してください。
                    </div>

                    <h2>最終内容確認</h2>
                    <p>ご予約内容をご確認ください。<br>以下の内容でよろしければ画面下の【完了する】ボタンをクリックしてください。</p>
                    <form method="POST" action="{{ route('confirmationitems.store') }}">
                        @csrf
                        <div class="mt-6">
                            <h4>予約についてのご要望などメッセージがございましたらご記入ください</h4>
                        </div>

                        <div class="mt-6">
                            <h5 class="">予約日</h5>
                            <p></p>
                        </div>

                        <div class="mt-6">
                            <h5 class="">時間</h5>
                            <p></p>
                        </div>

                        <div class="mt-6">
                            <h5 class="">ご希望の店舗</h5>
                            <p></p>
                        </div>

                        <div class="mt-6">
                            <h5 class="">作業カテゴリ</h5>
                            <p></p>
                        </div>

                        <div class="mt-6">
                            <h5 class="">予約する作業</h5>
                            <p></p>
                        </div>

                        <div class="mt-6">
                            <h4>確認事項</h4>
                        </div>
                        <!-- 予約日時 -->
                        <div class="mt-6">
                            <h5 class="">【車両選択】複数お車をご登録されている方は、何台目に登録されているお車か選択してください。</h5>
                            <p>{{ $finalcheck['vehicle'] }}</p>
                            <input type="hidden" name="vehicle" value="{{ $finalcheck['vehicle'] }}">
                        </div>

                        <!-- 追加装備 -->
                        <div class="mt-6">
                            <h5 class="">【追加整備】本作業とあわせて追加作業を依頼したい場合にお選びください。</h5>
                            @foreach ($finalcheck['additional_services'] as $service)
                            <p>{{ $service }}</p>
                            @endforeach
                            <input type="hidden" name="vehicle" value="{{ implode(', ', $finalcheck['additional_services']) }}">
                        </div>

                        <!-- 車検満期日 -->
                        <div class="mt-6">
                            <h5 class="">車検満期日をご入力ください。</h5>
                            <p>{{ $finalcheck['inspection_due_date'] }}</p>
                            <input type="hidden" name="vehicle" value="{{ $finalcheck['inspection_due_date'] }}">
                        </div>

                        <!-- 過去利用履歴 -->
                        <div class="mt-6">
                            <h5 class="">今回ご予約いただく店舗・作業は、過去にご利用がございますか？</h5>
                            <p>{{ $finalcheck['past_service_history'] }}</p>
                            <input type="hidden" name="vehicle" value="{{ $finalcheck['past_service_history'] }}">
                        </div>

                        <div class="mt-6">
                            <h4>予約者情報</h4>
                        </div>

                        <!-- 顧客名 -->
                        <div class="mt-6">
                            <h5 class="">顧客名</h5>
                            <p>{{ $finalcheck['user']['name'] }}</p>
                        </div>

                        <div class="mt-6">
                            <h5 class="">フリガナ</h5>
                            <p>{{ $finalcheck['user']['name_furigana'] }}</p>
                        </div>

                        <div class="mt-6">
                            <h5 class="">生年月日</h5>
                            <p>{{ $finalcheck['user']['birthday'] }}</p>
                        </div>

                        <div class="mt-6">
                            <h5 class="">性別</h5>
                            <p>{{ $finalcheck['user']['gender'] }}</p>
                        </div>

                        <div class="mt-6">
                            <h5 class="">電話番号</h5>
                            <p>{{ $finalcheck['user']['phone_number'] }}</p>
                        </div>

                        <div class="mt-6">
                            <h5 class="">電話連絡の希望時間帯</h5>
                            <p>{{ $finalcheck['user']['call_time'] }}</p>
                        </div>

                        <div class="mt-6">
                            <h5 class="">郵便番号</h5>
                            <p>{{ $finalcheck['user']['zipcode'] }}</p>
                        </div>

                        <div class="mt-6">
                            <h5 class="">都道府県</h5>
                            <p>{{ $finalcheck['user']['prefecture'] }}</p>
                        </div>

                        <div class="mt-6">
                            <h5 class="">市町村番地</h5>
                            <p>{{ $finalcheck['user']['address1'] }}</p>
                        </div>

                        @if(!empty($finalcheck['user']['address2']))
                        <div class="mt-6">
                            <h5 class="">建物名など</h5>
                            <p>{{ $finalcheck['user']['address2'] }}</p>
                        </div>
                        @endif

                        <div class="mt-6">
                            <h5 class="">車名(1台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car1_name'] }}</p>
                        </div>

                        @if(!empty($finalcheck['vehicles']['car1_katashiki']))
                        <div class="mt-6">
                            <h5 class="">型式(1台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car1_katashiki'] }}</p>
                        </div>
                        @endif

                        <div class="mt-6">
                            <h5 class="">ナンバー(1台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car1_number'] }}</p>
                        </div>

                        @if(!empty($finalcheck['vehicles']['car1_class']))
                        <div class="mt-6">
                            <h5 class="">車種区分(1台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car1_class'] }}</p>
                        </div>
                        @endif

                        @if(!empty($finalcheck['vehicles']['car2_class']))
                        <div class="mt-6">
                            <h5 class="">車名(2台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car2_name'] }}</p>
                        </div>
                        @endif

                        @if(!empty($finalcheck['vehicles']['car2_class']))
                        <div class="mt-6">
                            <h5 class="">型式(2台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car2_katashiki'] }}</p>
                        </div>
                        @endif

                        @if(!empty($finalcheck['vehicles']['car2_class']))
                        <div class="mt-6">
                            <h5 class="">ナンバー(2台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car2_number'] }}</p>
                        </div>
                        @endif

                        @if(!empty($finalcheck['vehicles']['car2_class']))
                        <div class="mt-6">
                            <h5 class="">車種区分(2台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car2_class'] }}</p>
                        </div>
                        @endif

                        @if(!empty($finalcheck['vehicles']['car3_class']))
                        <div class="mt-6">
                            <h5 class="">車名(3台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car3_name'] }}</p>
                        </div>
                        @endif

                        @if(!empty($finalcheck['vehicles']['car3_class']))
                        <div class="mt-6">
                            <h5 class="">型式(3台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car3_katashiki'] }}</p>
                        </div>
                        @endif

                        @if(!empty($finalcheck['vehicles']['car3_class']))
                        <div class="mt-6">
                            <h5 class="">ナンバー(3台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car3_number'] }}</p>
                        </div>
                        @endif

                        @if(!empty($finalcheck['vehicles']['car3_class']))
                        <div class="mt-6">
                            <h5 class="">車種区分(3台目)</h5>
                            <p>{{ $finalcheck['vehicles']['car3_class'] }}</p>
                        </div>
                        @endif

                        @if(!empty($finalcheck['user']['is_receive_newsletter']))
                        <div class="mt-6">
                            <h5 class="">メルマガ配信</h5>
                            <p>{{ $finalcheck['user']['is_receive_newsletter'] }}</p>
                        </div>
                        @endif

                        <div class="mt-6">
                            <h5 class="">[アンケート]弊社の車検を何でお知りになりましたか？(複数回答3つまで)</h5>
                            <ul>
                                @foreach ($anket as $answerId)
                                    <li>{{ $anketnames[$answerId] }}</li>
                                @endforeach
                            </ul>
                        </div>

                        @if(!empty($finalcheck['user']['manager']))
                        <div class="mt-6">
                            <h5 class="">担当者</h5>
                            <p>{{ $finalcheck['user']['manager'] }}</p>
                        </div>
                        @endif

                        @if(!empty($finalcheck['user']['department']))
                        <div class="mt-6">
                            <h5 class="">部署名／支店名</h5>
                            <p>{{ $finalcheck['user']['department'] }}</p>
                        </div>
                        @endif

                        <div class="mt-6">
                            <h4>予約についてのご要望などメッセージがございましたらご記入ください</h4>
                        </div>

                        <textarea name=""class=""></textarea>

                        <!-- 確定ボタン -->
                        <div class="mt-6">
                            <x-primary-button class="ml-4" type="submit">
                                {{ __('予約を確定') }}
                            </x-primary-button>
                        </div>
                    </form>
                    <a href="{{ route('confirmationitems.index') }}" class="text-blue-600">戻る</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
