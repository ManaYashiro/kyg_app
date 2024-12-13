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
        <div class="bg-white overflow-hidden">
                    <div class="mt-4 ">
                        <x-text.custom-text text="キムラユニティー・オートプラザラビット各店の" class="text-xl font-bold" />
                        <x-text.custom-text text="車検やオイル交換、タイヤ交換などの予約ができます。" class="text-xl font-bold" />
                        <x-text.custom-text text="ご利用方法は右上「MENU」内ご利用ガイドをご覧ください。" class="mt-4 text-sm font-bold" />
                    </div>
                    <hr class="my-14 border-1 border-gray-300">
                    <div class="mt-4 flex items-start">
                        <div class="text-white rounded-full bg-red-600 px-6 py-1 text-sm" >お知らせ</div>
                        <div class="ml-4 flex flex-col sm:flex-row">
                            <x-text.custom-text text="2024/11/11" class="text-gray-500 text-sm sm:mr-4" />
                            <div class="text-sm font-bold">
                                <x-text.custom-text text="スーパージャンボ【中川店専用予約ページ】を開設しました。" class="text-sm font-bold" />
                                中川店へのご予約はこちら>>
                                <a href="https://sj-yoyaku.resv.jp" class="text-blue-500 underline">https://sj-yoyaku.resv.jp</a>
                            </div>
                        </div>
                    </div>
                    <hr class="my-10 border-2 border-gray-300">
                    <div class="text-gray-800">
                        <div class="flex justify-start items-center gap-2">
                            <x-text.custom-text text="●" class="font-bold text-xl text-red-600" />
                            <x-text.custom-text text="初めてご利用の方へ" class="font-bold text-xl" />
                        </div>
                            <ul class="list-disc ml-6 mt-2 text-base font-bold">
                                    <li>・まずはじめに【会員登録】をお願いします。登録完了後にご登録いただいたIDパスワードにてログインください。<br></li>
                                    <li>※ログイン後に全ての店舗やメニューが表示されるようになります。</li>
                                <div class="flex justify-start items-center gap-1  mt-7">
                                    <x-text.custom-text text="■" class="font-bold text-xs text-red-600"></x-text.custom-text>
                                    <x-text.custom-text text="受付は希望日の3ヶ月前～3日前まで" class="font-bold text-xl"></x-text.custom-text>
                                </div>
                                <ul class="list-disc ml-6 mt-2 text-sm">
                                    <li>・直前のご予約や7日前以降のキャンセルは店舗までお電話下さい。</li>
                                    <li>・予約を変更したい場合は一旦キャンセルしてから再度ご予約下さい。</li>
                                    <li>・車検は満期日の３０日前から受けられます。</li>
                                </ul>
                                <div class="flex justify-start items-center gap-1  mt-7">
                                    <x-text.custom-text text="■" class="font-bold text-xs text-red-600"></x-text.custom-text>
                                    <x-text.custom-text text="★ 個人／☆法人 メニューにご注意下さい" class="font-bold text-xl"></x-text.custom-text>
                                </div>
                                <ul class="list-disc ml-6 mt-2 text-sm">
                                    <li>・店舗によりリースメンテ契約車両のメニュー（☆法人）がございます。</li>
                                    <li>・一般の方は★個人のメニューからお選びください。</li>
                                </ul>
                                <div class="flex justify-start items-center gap-1  mt-4">
                                    <x-text.custom-text text="■" class="font-bold text-xs text-red-600"></x-text.custom-text>
                                    <x-text.custom-text text="車検切れ車両のご予約を行う場合は、必ず別途 電話にてご連絡ください" class="font-bold text-xl"></x-text.custom-text>
                                </div>
                            </ul>
                            <div class="mt-6 text-red-600 font-bold text-xl">
                                <x-text.custom-text text="■ご利用に際して予めご了承ください" class="text-xl font-bold" />
                            </div>
                            <ul class="list-none ml-6 mt-2 text-base font-bold">
                                <li class="flex items-center">
                                    <span class="w-4 h-4 border-2 border-black mr-2 flex-shrink-0 rounded-sm">
                                        <svg class="w-4 h-4 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 6L9 17l-5-5"></path>
                                        </svg>
                                    </span>
                                    車検証の情報提供をお願いする場合がございます。<br>（事前に部品の手配が必要な場合など）
                                </li>
                                <li class="flex items-center">
                                    <span class="w-4 h-4 border-2 border-black mr-2 flex-shrink-0 rounded-sm">
                                        <svg class="w-4 h-4 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 6L9 17l-5-5"></path>
                                        </svg>
                                    </span>
                                    急を要する場合等には直接お電話させて頂く場合がございます。
                                </li>
                            </ul>
                        </div>
                    <div>
                    <div>
                        <div class="flex justify-start items-center gap-3 mt-7 mx-10">
                            <x-text.custom-text text="STEP 01" class="font-bold text-3xl text-red-600"></x-text.custom-text>
                            <x-text.custom-text text="ご希望の店舗をお選び下さい。" class="font-bold text-xl"></x-text.custom-text>
                        </div>
                    </div>
                    <hr class="my-3 border-2 border-red-600">
                    <div class="flex space-x-4 mt-8 mx-10 items-center">
                        <button class="text-white bg-red-600 p-2 rounded-md hover:bg-red-500 w-32">稲沢本店</button>
                        <div class="font-bold p-4 text-xs text-left grow">〒492-8224  愛知県稲沢市奥田大沢町3-1 9:00-19:00 水曜定休</div>
                        <div class="text-red-600 font-bold p-4 text-right grow">さらに詳しく</div>
                    </div>
                    <hr class="my-3 border-1 border-red-300  mx-10">
                    <div class="flex space-x-4 mx-10 items-center">
                        <button class="text-white bg-red-600 p-2 rounded-md hover:bg-red-500 w-32">名古屋北店</button>
                        <div class="font-bold p-4 text-xs text-left grow">〒462-0034  愛知県名古屋市北区天道町5丁目21 9:00-18:00 日曜・祝日定休</div>
                        <div class="text-red-600 font-bold p-4 text-right grow">さらに詳しく</div>
                    </div>
                    <hr class="my-3 border-2 border-red-300  mx-10">
                    <div class="flex space-x-4 mx-10 items-center">
                            <button class="text-white bg-red-600 p-2 rounded-md hover:bg-red-500 w-32">刈谷店</button>
                            <div class="font-bold p-4 text-xs text-left grow">〒448-0006  愛知県刈谷市西境町治右田140 9:00-19:00 日祝日9:00-17:00　水曜定休</div>
                            <div class="text-red-600 font-bold p-4 text-right grow">さらに詳しく</div>
                    </div>
                    <hr class="my-3 border-1 border-red-300  mx-10">
                    <div class="flex space-x-4 mx-10 items-center">
                        <button class="text-white bg-red-600 p-2 rounded-md hover:bg-red-500 w-32">錦店</button>
                        <div class="font-bold p-4 text-xs text-left grow">〒460-0003  愛知県名古屋市錦3-8-32 9:00-18:00 日祝日9:00-17:00　日祝日定休</div>
                        <div class="text-red-600 font-bold p-4 text-right grow">さらに詳しく</div>
                    </div>
                    <hr class="my-3 border-2 border-red-300  mx-10">
                    <div class="flex space-x-4 mx-10 items-center">
                        <button class="text-white bg-red-600 p-2 rounded-md hover:bg-red-500 w-32">豊田上郷店</button>
                        <div class="font-bold p-4 text-xs text-left grow">〒470-1213  愛知県稲沢市奥田大沢町3-1 9:00-18:00 日祝日9:00-17:00 水曜定休</div>
                        <div class="text-red-600 font-bold p-4 text-right grow">さらに詳しく</div>
                    </div>
                    <hr class="my-3 border-2 border-red-300  mx-10">
                    <div class="flex space-x-4 mx-10 items-center">
                        <button class="text-white bg-red-600 p-2 rounded-md hover:bg-red-500 w-32">犬山店</button>
                        <div class="font-bold p-4 text-xs text-left grow">〒484-0912  愛知県刈犬山市字舟田10 9:00-18:00 水曜定休</div>
                        <div class="text-red-600 font-bold p-4 text-right grow">さらに詳しく</div>
                    </div>
                    <div class="flex justify-start items-center gap-3 mt-14">
                        <x-text.custom-text text="STEP 02" class="font-bold text-3xl text-red-600"></x-text.custom-text>
                        <x-text.custom-text text="作業カテゴリをお選び下さい。" class="font-bold text-xl"></x-text.custom-text>
                    </div>
                    </div>
                    <hr class="my-3 border-2 border-red-600">
                    <div class="flex gap-4 mt-8">
                        <button class="text-white bg-red-600 p-10 w-[180px] rounded-md hover:bg-red-500 flex justify-center items-center">
                            車検（00分開始）
                        </button>
                        <button class="text-white bg-red-600 p-4 w-[180px] rounded-md hover:bg-red-500 flex justify-center items-center">
                             車検（30分開始）
                        </button>
                        <button class="text-white bg-red-600 p-4 w-[180px] rounded-md hover:bg-red-500 flex justify-center items-center">
                            点検整備・見積もり
                        </button>
                    </div>
                    <div>
                        <div class="flex justify-start items-center gap-3 mt-14">
                            <x-text.custom-text text="STEP 03" class="font-bold text-3xl text-red-600"></x-text.custom-text>
                            <x-text.custom-text text="個人・法人をお選びください。" class="font-bold text-xl"></x-text.custom-text>
                        </div>
                    </div>
                    <hr class="my-3 border-2 border-red-600">
                    <div class="flex gap-4 mt-8">
                        <button class="text-white grow bg-red-600 p-4 rounded-md hover:bg-red-500">個人のお客様</button>
                        <button class="text-white grow bg-red-600 p-4 rounded-md hover:bg-red-500">法人のお客様</button>
                    </div>
                    <div>
                        <div class="flex justify-start items-center gap-3 mt-14">
                            <x-text.custom-text text="STEP 04" class="font-bold text-3xl text-red-600"></x-text.custom-text>
                            <x-text.custom-text text="予約する作業をお選びください。" class="font-bold text-xl"></x-text.custom-text>
                        </div>
                    </div>
                    <hr class="my-3 border-2 border-red-600">
                    <div>
                        <div class="flex space-x-4  mx-10">
                            <button class="text-white grow bg-red-600 p-4 rounded hover:bg-red-500">☑</button>
                            <div class="grow font-bold p-4">★個人★車検ラビット４５（00分開始）（60分）</div>
                            <div class="text-red-600 font-bold grow p-4">さらに詳しく</div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-start items-center gap-3 mt-7">
                            <x-text.custom-text text="STEP 05" class="font-bold text-3xl text-red-600"></x-text.custom-text>
                            <x-text.custom-text text="予約する日時をお選びください。" class="font-bold text-xl"></x-text.custom-text>
                        </div>
                    </div>
                    <hr class="my-3 border-2 border-red-600">
                    {{-- <div>
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
                    </div>--}}
                    <div>
                        <div id="app">
                            <div id='calendar'></div>
                        </div>
                        <label>〇受付中</label>
                        <label>✕受付終了</label>
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
        @vite(['resources/css/calender.css,resources/css/top.css'])
    @endsection
    @push('scripts')
        @vite(['resources/js/modules/calender.js'])
    @endpush
</x-app-layout>
