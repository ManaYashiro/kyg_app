<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Store Introduction') }}
        </h2>
    </x-slot>

    <div class="w-full flex-1 max-w-screen-lg relative m-auto">
        <div class="w-full my-8 m-auto px-6 py-4 bg-white shadow-md">
            <div class="mb-3 bottom-border-text font-bold">
                <span class="">店紹介</span>
            </div>
            <div id="" class="left-border-text">
                <span class="">店名</span>
            </div>
            <span class="">キムラユニティーグループ</span>

            <div id="" class="left-border-text">
                <span class="">グループブランド</span>
            </div>
            <span class="">
                <ul>
                    <li>
                        ・キムラユニティー株式会社（東証一部）
                    </li>
                    <li>
                        ・オートプラザ ラビット
                    </li>
                    <li>
                        ・株式会社 スーパージャンボ
                    </li>
                </ul>
            </span>

            <div id="" class="left-border-text">
                <span class="">取扱い商品サービス</span>
            </div>
            <span class="">
                自動車販売・車検点検整備・鈑金塗装・自動車保険・カーコーティング・カー用品
            </span>

            <div id="" class="left-border-text">
                <span class="">WEBサイト</span>
            </div>
            <div class="flex flex-col">
                <span>
                    カーライフサービス&nbsp;&nbsp;<a href="http://carlife-service.com/">http://carlife-service.com/</a>
                </span>
                <span>
                    コーポレートサイト&nbsp;&nbsp;<a href="http://www.kimura-unity.co.jp/">http://www.kimura-unity.co.jp/</a>
                </span>
            </div>
        </div>
    </div>
</x-app-layout>
