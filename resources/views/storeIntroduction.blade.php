<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Store Introduction') }}
        </h2>
    </x-slot>

    <div class="w-full flex-1 max-w-screen-lg relative m-auto">
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
            <div class="flex flex-col gap-1 sm:flex-row sm:gap-3">
                <span>カーライフサービス</span>
                <a href="https://www.carlife-service.com" class="text-blue-700">https://www.carlife-service.com</a>
            </div>
            <div class="flex flex-col gap-1 sm:flex-row sm:gap-3">
                <span>コーポレートサイト</span>
                <a href="https://www.kimura-unity.co.jp" class="text-blue-700">https://www.kimura-unity.co.jp</a>
            </div>
        </div>
    </div>
</x-app-layout>
