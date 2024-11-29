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

    <main class="mt-6">
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
                    <div>
                        ご希望の店舗をお選び下さい。
                    </div>
                </div>
                <div>
                    <div>
                        作業カテゴリをお選び下さい。
                    </div>
                </div>
                <div>
                    <div>
                        予約する作業をお選び下さい。
                    </div>
                </div>
                <div>
                    <div>
                        予約日時を選択
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
