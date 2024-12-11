<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Frequently Asked Questions') }}
        </h2>
    </x-slot>

    <div class="w-full flex-1 max-w-screen-lg relative m-auto">
        <div class="w-full my-8 m-auto px-6 py-4 bg-white shadow-md">

            <div class="mb-3 bottom-border-text font-bold">
                <span class="">よくある質問</span>
            </div>
            <div id="" class="mb-6 font-bold text-sm">
                <span class="">過去に多かったお問合せについて回答を掲載しています。</span>
            </div>

            <div id="" class="left-border-text">
                <span class="text-red-1000">
                    Ｑ1.ログインID・パスワードを忘れてしまいました。
                </span>
            </div>
            <span class="">
                Ａ．【個人の方】<br>
                ログインページの「※パスワードの再設定はこちら」から、ご登録のメールアドレスをご入力いただきますと、ログインＩＤのご確認ならびにパスワードを再設定するメールをお送り致します。<br>
                <br>
                【リースメンテ契約の法人様】<br>
                メールにて下記情報を記載してお送りください。ご本人様の確認ができましたら、ログインIDを返信致します。<br>
                ①ご登録者のお名前　②メールアドレス　③ご登録の電話番号　④ご住所　⑤法人名<br>
                （送信先アドレス）kuc_app@kimura-unity.com
            </span>

            <div class="border border-dotted my-4 "></div>

            <div id="" class="left-border-text">
                <span class="text-red-1000">
                    Ｑ2.受信するメールアドレスの変更や、２台目の車を登録したいのですが？
                </span>
            </div>
            <span class="">
                Ａ.マイページで変更・追加ができます。<br>
                ログインの後、マイページからお客様の情報（ID、パスワード、メールアドレスなど）やお車の情報を更新いただけます。お車は最大3台まで登録できます。
            </span>

            <div class="border border-dotted my-4 "></div>

            <div id="" class="left-border-text">
                <span class="text-red-1000">
                    Ｑ3.受付完了などのメールが届きません。
                </span>
            </div>
            <span class="">
                Ａ.メールが受信できない主な原因について下記の項目が挙げられます。<br>
                【受信制限の設定】<br>
                スマートフォンや携帯電話のメール設定でドメイン指定受信をされている場合は、以下のメールアドレスのドメイン受信許容の設定してください。<br>
                @resv.jp<br>
                <br>
                【迷惑メールフォルダに入っている】<br>
                迷惑メールフィルターを利用されている場合、予約システムからの配信メールが[迷惑メール]フォルダーに振り分けられることがあります。<br>
                <br>
                【なりすましメール拒否機能を利用している】<br>
                「なりすましメール拒否機能」とは、メールの送信元メールアドレスを偽装しているメールを受信拒否する機能です。 お客様にとって必要なメールでも、なりすましの<br>
                疑いがあると判断された場合は、受信拒否の対象となり受信できませんので、一度この機能を無効にしてからメール受信をお試しください。<br>
                <br>
                【登録メールアドレスの誤り】<br>
                ご登録いただいたメールアドレスに誤りがないか、マイページよりご確認ください。<br>
                <br>
                【法人IDを共有している場合】<br>
                法人様でＩＤを共有されている場合、ＩＤに登録されているメールアドレスにのみ送信されます。必ずしも、ご予約者ご本人にメールが行きませんのでご了承下さい。ご予約の確認は、マイページの予約の確認から行えます。<br>
            </span>

            <div class="border border-dotted my-4 "></div>

            <div id="" class="left-border-text">
                <span class="text-red-1000">
                    Ｑ4.予約した日時を変更したいのですが。
                </span>
            </div>
            <span class="">
                Ａ.予約日の7日前なら予約サイトから手続きできます。<br>
                その場合、マイページで予約をキャンセルしていただき、再度変更したい日時でご予約下さい。<br>
                また予約日の6日前を過ぎている場合は、お電話にて直接店舗へ変更希望日時をお伝えください。 </span>
            </span>

            <div class="border border-dotted my-4 "></div>

            <div id="" class="left-border-text">
                <span class="text-red-1000">
                    Ｑ5.来店作業でなくてもWEBで予約ができますか？
                </span>
            </div>
            <span class="">
                A.できません。<br>
                ＷＥＢ予約は個人様・法人様問わず、お車持ち込みによる作業限定でご利用いただけます。リースメンテ契約車両で引取納車をご希望の際は、恐れ入りますがお電話かメールにてご予約ください。<br>
                （法人予約センター）<a href="kuc_app@kimura-unity.com">kuc_app@kimura-unity.com</a>
            </span>

            <div class="border border-dotted my-4 "></div>

            <div id="" class="left-border-text">
                <span class="text-red-1000">
                    Ｑ6.【法人ID】車両使用者ら複数人でIDを共有したいのですが？
                </span>
            </div>
            <span class="">
                Ａ.可能です。<br>
                例えば社内でID・PWを共有し、複数の車両や使用者の方から予約を申し込んで頂くことも可能です。ただし、予約サイトからのお知らせメールはID登録していただいたメールアドレスにのみ送信されますので、その点はご了承ください。
            </span>
        </div>
    </div>

</x-app-layout>
