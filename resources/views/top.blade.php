<x-app-layout>
    <x-slot name="top">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight font-color-r">
            {{ __('Top') }}
        </h2>
        <div class="flex space-x-2 mt-2">
        </div>
    </x-slot>

    @if (session()->has('verify-email'))
        <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
            {!! session('verify-email') !!}
        </div>
    @endif

    <main class="mt-4">
        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
            <div>
                <div>
                    キムラユニティーグループのWEB予約ページへようこそ。
                </div>
                <div>
                    キムラユニティー・オートプラザラビット各店の車検やオイル交換、タイヤ交換などの予約ができます。
                    ●ご利用方法は右上「MENU」内ご利用ガイドをご覧ください。
                </div>

                <div>
                    <div>
                        【 お知らせ 】―――――――――――――――――――――――――――――――――――――――
                        スーパージャンボ【中川店専用予約ページ】を開設しました。
                    </div>
                    <div>
                        <div>
                            中川店へのご予約は
                        </div>
                        <a href="https://sj-yoyaku.resv.jp">
                            こちら
                        </a>
                    </div>
                    <div>
                        ――――――――――――――――――――――――――――――――――――――――――――――
                    </div>
                </div>

                <div>
                    <div>
                        【初めてご利用の方へ】
                    </div>
                    <div>
                        ・まずはじめに【会員登録】をお願いします。登録完了後にご登録いただいたIDパスワードにてログインください。
                        ※ログイン後に全ての店舗やメニューが表示されるようになります。
                    </div>
                    <div>
                        ★受付は希望日の3ヶ月前～３日前まで
                    </div>
                    <div>
                        ※直前のご予約や7日前以降のキャンセルは店舗までお電話下さい。
                        ※予約を変更したい場合は一旦キャンセルしてから再度ご予約下さい。
                        ※車検は満期日の３０日前から受けられます。
                    </div>
                    <div>
                        ★個人／☆法人 メニューにご注意下さい
                    </div>
                    <div>
                        ※店舗によりリースメンテ契約車両のメニュー（☆法人）がございます。
                        ※一般の方は★個人のメニューからお選びください。
                    </div>
                    <div>
                        ★車検切れ車両のご予約を行う場合は、必ず別途 電話にてご連絡ください
                    </div>
                </div>

                <div>
                    <div>
                        ＜ご利用に際して予めご了承ください＞
                    </div>
                    <div>
                        ■車検証の情報提供をお願いする場合がございます。
                        （事前に部品の手配が必要な場合など）
                        ■急を要する場合等には直接お電話させて頂く場合がございます。
                    </div>
                </div>

                <div>
                    <label for="store">ご希望の店舗をお選び下さい。</label>
                    <div class="flex items-center">
                        <select class="block mt-1 w-full" id="store" name="store">
                            <option value="0">-- 選択してください --</option>
                            <option value="1">稲沢本店</option>
                            <option value="2">名古屋北店</option>
                            <option value="3">刈谷店</option>
                            <option value="4">錦店</option>
                            <option value="5">豊田上郷店</option>
                            <option value="6">犬山店</option>
                        </select>
                        <button type="button" id="storedetails" class="ml-4 mt-2">詳細</button>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="taskcategory">作業カテゴリをお選び下さい。</label>
                        <div class="flex items-center">
                            <select class="block mt-1 w-full" id="taskcategory" name="taskcategory">
                                <option value="0">-- 選択してください --</option>

                            </select>
                            <button type="button" id="workdetails" class="ml-4 mt-2">詳細</button>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="reservationtask">予約する作業をお選び下さい。</label>
                        <div class="flex items-center">
                            <select class="block mt-1 w-full" id="reservationtask" name="reservationtask">
                                <option value="0">-- 選択してください --</option>
                            </select>
                            <button type="button" id="reservationdetails" class="ml-4 mt-2">詳細</button>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        予約日時を選択
                    </div>
                    <div id="app">
                        <div id='calendar'></div>
                    </div>
                    <label>〇受付中</label>
                    <label>✕受付終了</label>
                </div>
            </div>
        </div>
        <!-- モーダル -->
        <!-- 店舗 -->
        <div id="storeModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 justify-center items-center">
            <div class="bg-white p-6 rounded shadow-md w-1/2">
                <h2 id="modalTitle" class="text-xl font-bold mb-4"></h2>
                <p id="modalContent"></p>
                <!-- ボタンを中央揃え -->
                <div class="flex justify-center">
                    <button id="closeModal" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">閉じる</button>
                </div>
            </div>
        </div>
        <!-- 作業 -->
        <div id="taskModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 justify-center items-center">
            <div class="bg-white p-6 rounded shadow-md w-1/2">
                <h2 id="modalTitle" class="text-xl font-bold mb-4"></h2>
                <p id="modalContent"></p>
                <!-- ボタンを中央揃え -->
                <div class="flex justify-center">
                    <button id="closeModal" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">閉じる</button>
                </div>
            </div>
        </div>
        <!-- 予約 -->
        <div id="reservationModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 justify-center items-center">
            <div class="bg-white p-6 rounded shadow-md w-1/2">
                <h2 id="modalTitle" class="text-xl font-bold mb-4"></h2>
                <p id="modalContent"></p>
                <!-- ボタンを中央揃え -->
                <div class="flex justify-center">
                    <button id="closeModal" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">閉じる</button>
                </div>
            </div>
        </div>
    </main>

    @section('styles')
        @vite(['resources/css/calender.css'])
    @endsection
    @push('scripts')
        @vite(['resources/js/modules/calender.js'])
    @endpush
</x-app-layout>
