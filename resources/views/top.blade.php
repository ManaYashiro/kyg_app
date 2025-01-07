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
    <main>
        <div class="bg-white md:mx-10">
            <div class="mt-14">
                <x-text.custom-text text="キムラユニティー・オートプラザラビット各店の" class="text-xl font-bold" />
                <x-text.custom-text text="車検やオイル交換、タイヤ交換などの予約ができます。" class="text-xl font-bold" />
                <x-text.custom-text text="ご利用方法は右上「MENU」内ご利用ガイドをご覧ください。" class="mt-4 text-sm font-bold" />
            </div>
            <hr class="my-10 border-1 border-gray-300 -mx-4 md:-mx-14">
            <div class="mt-2 flex flex-col gap-4 sm:flex-row sm:gap-8">
                <div class="flex gap-4 items-center sm:items-start">
                    <span class="text-white rounded-full bg-red-600 px-6 py-1 text-sm ">お知らせ</span>
                    <x-text.custom-text text="2024/11/11" class="col-span-1 text-gray-500 text-sm" />
                </div>
                <div class="flex-grow md:flex-grow-0">
                    <div class="text-sm font-bold">
                        <x-text.custom-text text="スーパージャンボ【中川店専用予約ページ】を開設しました。" class="text-sm font-bold" />
                        中川店へのご予約はこちら>>
                        <a href="https://sj-yoyaku.resv.jp"
                            class="text-blue-500 underline">https://sj-yoyaku.resv.jp</a>
                    </div>
                </div>
            </div>
            <hr class="my-10 border-1 border-gray-300 -mx-4 md:-mx-14">
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
                        <x-text.custom-text text="車検切れ車両のご予約を行う場合は、必ず別途 電話にてご連絡ください"
                            class="font-bold text-xl"></x-text.custom-text>
                    </div>
                </ul>
                <div class="flex justify-start items-center gap-2 mt-4">
                    <img src="{{ Vite::asset('resources/img/top/warning.png') }}" alt="注意">
                    <x-text.custom-text text="ご利用に際して予めご了承ください"
                        class="text-xl text-red-600 font-bold  inline-block border-b border-red-600" />
                </div>
                <ul class="list-none ml-6 mt-2 text-base font-bold">
                    <li class="flex items-center">
                        <span class="w-4 h-4 mr-2 flex-shrink-0 rounded-sm">
                            <img src="{{ Vite::asset('resources/img/top/check.png') }}" alt="注意">
                        </span>
                        車検証の情報提供をお願いする場合がございます。<br>（事前に部品の手配が必要な場合など）
                    </li>
                    <li class="flex items-center">
                        <span class="w-4 h-4 mr-2 flex-shrink-0 rounded-sm">
                            <img src="{{ Vite::asset('resources/img/top/check.png') }}" alt="注意">
                        </span>
                        急を要する場合等には直接お電話させて頂く場合がございます。
                    </li>
                </ul>
            </div>
            <div class="flex justify-start items-center gap-3 mt-7">
                <x-text.custom-text text="STEP 01" id="step01"
                    class="font-bold text-3xl text-red-600"></x-text.custom-text>
                <x-text.custom-text text="ご希望の店舗をお選び下さい。" class="font-bold text-xl"></x-text.custom-text>
            </div>
            <hr class="my-3 border-2 border-red-600 -mx-4 md:-mx-14">
            @include('components.top.step01-button', [
                'name' => '稲沢本店',
                'store_id' => 1,
                'address' => '〒492-8224 愛知県稲沢市奥田大沢町3-1　9:00-19:00 水曜定休',
            ])
            @include('components.top.step01-button', [
                'name' => '名古屋北店',
                'store_id' => 2,
                'address' => '〒462-0034 愛知県名古屋市北区天道町5丁目21　9:00-18:00 日・祝日定休',
            ])
            @include('components.top.step01-button', [
                'name' => '刈谷店',
                'store_id' => 3,
                'address' => '〒448-0006 愛知県刈谷市西境町治右田140　9:00-19:00 日祝日 9:00-17:00 水曜定休',
            ])
            @include('components.top.step01-button', [
                'name' => '錦店',
                'store_id' => 4,
                'address' => '〒460-0003 愛知県名古屋市錦3-8-32　9:00-18:00 日・祝日定休',
            ])
            @include('components.top.step01-button', [
                'name' => '豊田上郷店',
                'store_id' => 5,
                'address' => '〒470-1213 愛知県稲沢市奥田大沢町3-1　9:00-18:00 日祝日 9:00-17:00 水曜定休',
            ])
            @include('components.top.step01-button', [
                'name' => '犬山店',
                'store_id' => 6,
                'address' => '〒484-0912 愛知県刈犬山市字舟田10　9:00-18:00 水曜定休',
            ])

            <div class="flex justify-start items-center gap-3 mt-7">
                <x-text.custom-text text="STEP 02" id="step02"
                    class="font-bold text-3xl text-red-600"></x-text.custom-text>
                <x-text.custom-text text="作業カテゴリをお選び下さい。" class="font-bold text-xl"></x-text.custom-text>
            </div>
            <hr class="my-3 border-2 border-red-600 -mx-4 md:-mx-14">
            <div id="taskCategories" class="flex flex-wrap gap-4 items-center mt-8">
                <!-- 初期表示 -->
                <label id="task-category-label-1" class="custom-radio-button">
                    <input type="radio" name="taskcategory" value="" id="task-category-input-1"
                        class="hidden-radio rounded-md">
                    <span class="step02-button flex flex-col">
                        <div class="flex gap-2 w-[45%] items-center justify-center btn-img-container">
                            <img src="{{ Vite::asset('resources/img/top/inactive_maintenance.png') }}" alt="車検"
                                class="w-[50%] inactive-icon">
                            <img src="{{ Vite::asset('resources/img/top/active_maintenance.png') }}" alt="車検"
                                class="w-[50%] active-icon">
                        </div>
                        <span class="check-icon">✓</span><span id="task-category-span-1">車検（00分開始）</span>
                    </span>
                </label>
                <label id="task-category-label-2" class="custom-radio-button">
                    <input type="radio" name="taskcategory" value="" id="task-category-input-2"
                        class="hidden-radio rounded-md">
                    <span class="step02-button flex flex-col">
                        <div class="flex gap-2 w-[45%] items-center justify-center btn-img-container">
                            <img src="{{ Vite::asset('resources/img/top/inactive_maintenance.png') }}" alt="車検"
                                class="w-[50%] inactive-icon">
                            <img src="{{ Vite::asset('resources/img/top/active_maintenance.png') }}" alt="車検"
                                class="w-[50%] active-icon">
                        </div>
                        <span class="check-icon">✓</span><span id="task-category-span-2">車検（30分開始）</span>
                    </span>
                </label>
                <label id="task-category-label-3" class="custom-radio-button">
                    <input type="radio" name="taskcategory" value="" id="task-category-input-3"
                        class="hidden-radio rounded-md">
                    <span class="step02-button flex flex-col">
                        <div class="flex gap-2 w-[45%] items-center justify-center btn-img-container">
                            <img src="{{ Vite::asset('resources/img/top/inactive_estimate.png') }}" alt="車検"
                                class="w-[50%] inactive-icon">
                            <img src="{{ Vite::asset('resources/img/top/inactive_tool.png') }}" alt="車検"
                                class="w-[50%] inactive-icon">
                            <img src="{{ Vite::asset('resources/img/top/active_estimate.png') }}" alt="車検"
                                class="w-[50%] active-icon">
                            <img src="{{ Vite::asset('resources/img/top/active_tool.png') }}" alt="車検"
                                class="w-[50%] active-icon">
                        </div>
                        <span class="check-icon">✓</span><span id="task-category-span-3">点検整備・見積もり</span>
                    </span>
                </label>
            </div>
            <div class="flex justify-start items-center gap-3 mt-7">
                <x-text.custom-text text="STEP 03" id="step03"
                    class="font-bold text-3xl text-red-600"></x-text.custom-text>
                <x-text.custom-text text="個人・法人をお選びください。" class="font-bold text-xl"></x-text.custom-text>
            </div>
            <hr class="my-3 border-2 border-red-600 -mx-4 md:-mx-14">
            <div id="customers" class="flex flex-wrap gap-4 items-center">
                <label class="custom-radio-button">
                    <input type="radio" name="customer" value="個人" class="hidden-radio rounded-md">
                    <span class="step03-button">
                        <span class="check-icon">✓</span> 個人のお客様
                    </span>
                </label>
                <label class="custom-radio-button">
                    <input type="radio" name="customer" value="法人" class="hidden-radio rounded-md">
                    <span class="step03-button">
                        <span class="check-icon">✓</span> 法人のお客様
                    </span>
                </label>
            </div>
            <div class="flex justify-start items-center gap-3 mt-7">
                <x-text.custom-text text="STEP 04" id="step04"
                    class="font-bold text-3xl text-red-600"></x-text.custom-text>
                <x-text.custom-text text="予約する作業をお選びください。" class="font-bold text-xl"></x-text.custom-text>
            </div>
            <hr class="my-3 border-2 border-red-600 -mx-4 md:-mx-14">
            <div id="reservationTasks">
            </div>
            @include('components.top.step04-image')
            <div class="flex justify-start items-center gap-3 mt-7">
                <x-text.custom-text text="STEP 05" id="step05"
                    class="font-bold text-3xl text-red-600"></x-text.custom-text>
                <x-text.custom-text text="予約する日時をお選びください。" class="font-bold text-xl"></x-text.custom-text>
            </div>
            <hr class="my-3 border-2 border-red-600 -mx-4 md:-mx-14">
            <div id="calendar-container">
                <x-text.custom-text text="予約日時を選択" class="mb-3 bottom-border-text font-bold" />
                <div id='calendar'></div>
                <label>〇受付中</label>
                <label>✖受付終了</label>
            </div>
        </div>
    </main>
    @section('styles')
        @vite(['resources/css/modules/calendar.css'])
    @endsection
    @push('modals')
        @include('modules.modals.store-modal')
        @include('modules.modals.reservation-modal')
        @include('modules.modals.calendar-modal')
    @endpush
    @push('scripts')
        @vite(['resources/js/modules/calendar.js'])
    @endpush
</x-app-layout>
