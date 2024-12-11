<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Guide') }}
        </h2>
    </x-slot>


    <div class="w-full flex-1 max-w-screen-lg relative m-auto">
        <div class="w-full my-8 m-auto px-6 py-4 bg-white shadow-md">
            <div class="mb-3 bottom-border-text font-bold">
                <span class="">ご利用ガイド</span>
            </div>
            <div id="" class="mb-6 font-bold text-sm">
                <span class="">WEB予約のご利用に関する説明のページです。ご不明な点がありましたら「よくある質問」ページも併せてご参照ください。</span>
            </div>

            <div id="" class="left-border-text">
                <span class="text-red-1000">ＷＥＢ予約を初めてご利用の方へ</span>
            </div>
            <span class="">
                【個人で利用のお客様】<br>
                初めにWEB予約会員へのご登録をお願いします。<br>
                [パソコン]画面右上の「会員登録」よりお進みください。<br>
                [スマートフォン]画面上部の「MENU（メニュー）」よりお進みください。<br>
                <br>
                【リースメンテ契約の法人様】<br>
                ログインIDを弊社より発行いたしますので、下記ページよりID発行をお申込みください。<br>
                <a href="https://www.carmanagementservice.com/syaken/">https://www.carmanagementservice.com/syaken/</a>
            </span>

            <div class="border border-dotted my-4 "></div>

            <div id="" class="left-border-text">
                <span class="text-red-1000">ログインIDとパスワードについて</span>
            </div>
            <span class="">
                【個人で利用のお客様】<br>
                <ul>
                    <li>
                        ・IDとパスワードは記録するなどしてお忘れにならないようご注意ください。
                    </li>
                    <li>
                        ・1つのIDにつき、３台まで車両登録ができます。4台目以上登録をご希望の場合は、お手数ですが別のメールアドレスにて追加で会員登録をお願いします。
                    </li>
                </ul>
                <br>

                【リースメンテ契約の法人様】
                <ul>
                    <li>
                        ・法人様向けのログインIDは貴社内で共有してご利用いただけます。<br>
                        （管理者とは別の車両使用者の方が個別にWEB予約するなど）
                    </li>
                    <li>
                        ・管理者以外の方がパスワードを変更する際には、まず管理者の方へご確認ください。
                    </li>
                </ul>
            </span>

            <div class="border border-dotted my-4 "></div>

            <div id="" class="left-border-text">
                <span class="text-red-1000">ご予約から作業当日までの流れ</span>
            </div>
            <span class="">
                ログイン後、カレンダーページにてご予約ください。<br>
                <ul>
                    <li>
                        (1)ご希望の店舗をお選びください
                    </li>
                    <li>
                        (2)作業カテゴリ＞予約する作業をお選びください
                    </li>
                    <li>
                        (3)ご希望の作業日、時間をお選びください
                    </li>
                    <li>
                        (4)確認事項で質問にお答えください
                    </li>
                    <li>
                        (5)店舗への質問やご要望がありましたら連絡欄にご入力ください。
                    </li>
                    <li>
                        (6)確認画面にて予約内容に間違いがなければ「送信」ボタンを押してください
                    </li>
                    <li>
                        (7)作業日当日は、お忘れ物がないようご確認の上ご来店ください。
                    </li>
                </ul>
            </span>

            <div class="border border-dotted my-4 "></div>

            <div id="" class="left-border-text">
                <span class="text-red-1000">料金について</span>
            </div>
            <span class="">
                店舗からのメールにて概算の料金をご案内しております。<br>
                ※オイル交換は各店舗で料金が異なります。詳しくは直接店舗へお問い合わせください。<br>
                ※車検の公的費用のお支払は現金のみとなりますので、予めご用意ください。<br>
                ※車検整備料・点検料等については、各種クレジットカードでのお支払が可能です。<br>
            </span>

            <div class="border border-dotted my-4 "></div>

            <div id="" class="left-border-text">
                <span class="text-red-1000">キャンセルについて</span>
            </div>
            <span class="">
                【キャンセルの方法】<br>
                予約サイトからのキャンセルは予約日の7日前の23時59分まで手続できます。<br>
                マイページの「予約の確認」からキャンセル手続きを行ってください。<br>
                それ以降のキャンセルについては、お手数ですが店舗まで直接お電話ください。<br><br>
            </span>
            <span>
                （店舗連絡先）&nbsp;&nbsp;<a
                    href="https://www.carlife-service.com/store.html">https://www.carlife-service.com/store.html</a>
            </span>

            <div class="border border-dotted my-4 "></div>

            <div id="" class="left-border-text">
                <span class="text-red-1000">
                    作業日当日にお持ちいただくもの
                </span>
            </div>

            <span class="">
                <ul>
                    <li>
                        (1)自動車検査証（車検証）
                    </li>
                    <li>
                        (2)自動車納税証明書
                    </li>
                    <li>
                        (3)印鑑(認印)
                    </li>
                    <li>
                        (4)自賠責保険証
                    </li>
                    <li>
                        (5)現金（公的費用分）
                    </li>
                </ul><br>
            </span>

            <span class="my-6">
                【ホイール・ロックナットご利用中の方へ】<br>
                タイヤを外す作業（車検・点検・タイヤ付替）の際はロックナットアダプターを忘れずご持参ください。
            </span>

        </div>
    </div>
</x-app-layout>
