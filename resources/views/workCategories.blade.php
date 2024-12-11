<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Work categories') }}
        </h2>
    </x-slot>

    @php
        $events = [
            [
                'name' => '車検_稲沢（00分開始）',
                'store' => '稲沢本店',
                'description' => 'お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。',
            ],
            [
                'name' => '車検_稲沢（30分開始）',
                'store' => '稲沢本店',
                'description' => 'お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。',
            ],
            [
                'name' => '車検_名北（00分開始）',
                'store' => '名古屋北店',
                'description' => 'お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。',
            ],
            [
                'name' => '車検_名北（30分開始）土曜のみ',
                'store' => '名古屋北店',
                'description' => 'お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。',
            ],
            [
                'name' => '車検_刈谷',
                'store' => '刈谷店',
                'description' => 'お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。',
            ],
            [
                'name' => '車検_豊田',
                'store' => '豊田上郷店',
                'description' => 'お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。',
            ],
            [
                'name' => '車検_犬山',
                'store' => '豊田上郷店',
                'description' => 'お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。',
            ],
            [
                'name' => '車検_錦',
                'store' => '錦店',
                'description' => 'お仕事や家事で忙しいアナタに！追加作業がなければ、たった45分で車検が完了します。',
            ],
            ['name' => '点検整備・車検見積り_稲沢', 'store' => '稲沢本店', 'description' => ''],
            ['name' => '点検整備・車検見積り_名北', 'store' => '名古屋北店', 'description' => ''],
            ['name' => '点検整備・車検見積り_刈谷', 'store' => '刈谷店', 'description' => ''],
            ['name' => '点検整備・車検見積り_豊田', 'store' => '豊田上郷店', 'description' => ''],
            ['name' => '点検整備・車検見積り_犬山', 'store' => '犬山店', 'description' => ''],
            ['name' => '点検整備・車検見積り_錦', 'store' => '錦店', 'description' => ''],
        ];

        // ページネーション設定
        $perPage = 10; // 1ページに表示するデータの数
        $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1; // 現在のページ
        $totalItems = count($events); // 総アイテム数
        $totalPages = ceil($totalItems / $perPage); // 総ページ数

        // 表示するアイテムを切り出す
        $startIndex = ($currentPage - 1) * $perPage;
        $pagedItems = array_slice($events, $startIndex, $perPage);

        // ページネーションリンクの作成
        $previousPage = $currentPage > 1 ? $currentPage - 1 : null;
        $nextPage = $currentPage < $totalPages ? $currentPage + 1 : null;
    @endphp

    <div class="w-full flex-1 max-w-screen-lg relative m-auto">
        <div class="w-full my-8 m-auto px-6 py-4 bg-white shadow-md">
            <div class="mb-3 bottom-border-text font-bold">
                <span class="">作業カテゴリ一覧</span>
            </div>

            <!-- ページネーションの表示 -->
            <div class="mt-8">
                <div class="flex justify-center space-x-2 pager">
                    <!-- 前のページリンク -->
                    @if ($previousPage)
                        <a href="?page={{ $previousPage }}" class="">
                            ＜
                        </a>
                    @else
                        <span class="cursor-not-allowed">
                            ＜
                        </span>
                    @endif

                    <!-- ページリンク -->
                    @for ($page = 1; $page <= $totalPages; $page++)
                        <!-- 現在のページは無効化する -->
                        @if ($page === $currentPage)
                            <button type="button" class="cursor-not-number" disabled>
                                {{ $page }}
                            </button>
                        @else
                            <a href="?page={{ $page }}" class="">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    <!-- 次のページリンク -->
                    @if ($nextPage)
                        <a href="?page={{ $nextPage }}" class="">
                            ＞
                        </a>
                    @else
                        <span class="cursor-not-allowed">
                            ＞
                        </span>
                    @endif
                </div>
            </div>

            <!-- ページネーションされたイベント項目を表示 -->
            @foreach ($pagedItems as $event)
                <div class="event-block">
                    <div class="event-item">
                        <div class="event-name">
                            {{ $event['name'] }}
                        </div>
                        <ul class="spec">
                            <li>[ご希望の店舗] {{ $event['store'] }}</li>
                            @if (!empty($event['description']))
                                <li>{{ $event['description'] }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            @endforeach

            <!-- ページネーションの表示 -->
            <div class="mt-8">
                <div class="flex justify-center space-x-2 pager">
                    <!-- 前のページリンク -->
                    @if ($previousPage)
                        <a href="?page={{ $previousPage }}" class="">
                            ＜
                        </a>
                    @else
                        <span class="cursor-not-allowed">
                            ＜
                        </span>
                    @endif

                    <!-- ページリンク -->
                    @for ($page = 1; $page <= $totalPages; $page++)
                        <!-- 現在のページは無効化する -->
                        @if ($page === $currentPage)
                            <button type="button" class="cursor-not-number" disabled>
                                {{ $page }}
                            </button>
                        @else
                            <a href="?page={{ $page }}" class="">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    <!-- 次のページリンク -->
                    @if ($nextPage)
                        <a href="?page={{ $nextPage }}" class="">
                            ＞
                        </a>
                    @else
                        <span class="cursor-not-allowed">
                            ＞
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
