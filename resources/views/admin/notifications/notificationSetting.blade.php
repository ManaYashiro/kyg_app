<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm border border-gray-800 border-r-0 border-b-0">
        <div class="p-6 text-gray-900">
            <div class="overflow-x-auto mt-4">
                <div class="container mx-auto p-4">
                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <h2 class="text-xl font-semibold mb-4">お知らせ編集</h2>
                    @if (session('success'))
                        <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.notificationSetting.store') }}" method="POST"
                        enctype="multipart/form-data" id="notification-form">
                        @csrf
                        @method('POST')

                        <!-- ID -->
                        <input type="hidden" name="notification_id" id="notification-id" />

                        <!-- タイトル -->
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('タイトル')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title', $notification->title ?? '')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- 内容 -->
                        <div class="mb-4">
                            <x-input-label for="content" :value="__('本文')" />
                            <textarea name="content" id="content" class="block mt-1 w-full border-gray-300 rounded-md" rows="5" required>{{ old('content', $notification->content ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <!-- カテゴリー -->
                        <div class="mb-4">
                            <x-input-label for="category" :value="__('カテゴリー')" />
                            <x-select id="category" class="block mt-1 w-full" name="category" required>
                                <option value="" disabled selected>選択してください</option>
                                <option value="1">システムメンテナンス情報</option>
                                <option value="2">新機能・サービスの追加</option>
                                <option value="3">キャンペーン・割引情報</option>
                                <option value="4">予約状況や混雑情報</option>
                                <option value="5">不具合・障害情報</option>
                                <option value="6">特別イベント・ワークショップの案内</option>
                                <option value="7">お客様の声や事例紹介</option>
                                <option value="no_preference">指定なし</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <!-- 公開日 -->
                        <div class="mb-4">
                            <x-input-label for="published_at" :value="__('公開日')" />
                            <x-text-input id="published_at" class="block mt-1 w-full" type="date" name="published_at"
                                :value="old('published_at', $notification->published_at ?? '')" required />
                            <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                        </div>

                        <!-- 公開状態 -->
                        <div class="mb-4">
                            <x-input-label for="is_active" :value="__('公開状態')" />
                            <div class="flex items-center">
                                <label for="is_active_1" class="mr-4">
                                    <input type="radio" id="is_active_1" name="is_active" value="1"
                                        {{ old('is_active', $notification->is_active ?? '') == 1 ? 'checked' : '' }}
                                        required />
                                    {{ __('公開') }}
                                </label>

                                <label for="is_active_0">
                                    <input type="radio" id="is_active_0" name="is_active" value="0"
                                        {{ old('is_active', $notification->is_active ?? '') == 0 ? 'checked' : '' }}
                                        required />
                                    {{ __('非公開') }}
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                        </div>

                        <!-- 画像選択 -->
                        <div class="mb-4">
                            <x-input-label for="image" :value="__('画像')" />
                            <input type="file" id="image" name="image" />
                            <span id="file-name"></span> <!-- 選択されたファイル名を表示 -->
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <!-- 登録ボタン -->
                        <div class="mb-4 flex justify-end">
                            <x-primary-button class="ms-3">登録</x-primary-button>
                        </div>
                    </form>

                    <!-- 削除ボタン -->
                    @isset($notification)
                        <form action="{{ route('admin.notificationSetting.destroy', $notification->id) }}" method="POST"
                            onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <div class="mb-4 flex justify-end">
                                <button type="submit"
                                    class="ms-3 bg-red-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-800 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    削除
                                </button>
                            </div>
                        </form>
                    @endisset

                    <table class="min-w-full table-auto border-collapse" style="border: 1px solid #ccc;">
                        <!-- ヘッダー部分 -->
                        <thead class="bg-gray-200 sticky top-0 z-10">
                            <tr>
                                <th class="px-4 py-2 text-left" style="width: 16%;">ID</th>
                                <th class="px-4 py-2 text-left" style="width: 16%;">タイトル</th>
                                <th class="px-4 py-2 text-left" style="width: 16%;">カテゴリー</th>
                                <th class="px-4 py-2 text-left" style="width: 16%;">公開日</th>
                                <th class="px-4 py-2 text-left" style="width: 16%;">公開状態</th>
                                <th class="px-4 py-2 text-left" style="width: 16%;">画像</th>
                            </tr>
                        </thead>

                        <!-- ボディ部分 -->
                        <tbody>
                            @foreach ($notifications as $notification)
                                <tr class="clickable-row" data-id="{{ $notification->id }}"
                                    data-title="{{ $notification->title }}"
                                    data-content="{{ $notification->content }}"
                                    data-category="{{ $notification->category }}"
                                    data-published_at="{{ $notification->published_at }}"
                                    data-is_active="{{ $notification->is_active }}"
                                    data-image="{{ $notification->image }}" style="cursor: pointer;">
                                    <td class="border px-4 py-2 text-xs">{{ $notification->id }}</td>
                                    <td class="border px-4 py-2 text-xs">{{ $notification->title }}</td>
                                    <td class="border px-4 py-2 text-xs">
                                        @php
                                            $category = $notification->category; // ここは必要に応じて取得する方法を変更
                                        @endphp
                                        @switch($category)
                                            @case(1)
                                                システムメンテナンス情報
                                            @break

                                            @case(2)
                                                新機能・サービスの追加
                                            @break

                                            @case(3)
                                                キャンペーン・割引情報
                                            @break

                                            @case(4)
                                                予約状況や混雑情報
                                            @break

                                            @case(5)
                                                不具合・障害情報
                                            @break

                                            @case(6)
                                                特別イベント・ワークショップの案内
                                            @break

                                            @case(7)
                                                お客様の声や事例紹介
                                            @break

                                            @case('no_preference')
                                                指定なし
                                            @break

                                            @default
                                                未設定
                                            @break
                                        @endswitch
                                    </td>
                                    <td class="border px-4 py-2 text-xs">{{ $notification->published_at }}
                                    </td>
                                    <td class="border px-4 py-2 text-xs">
                                        {{ $notification->is_active ? '公開' : '非公開' }}</td>
                                    <td class="border px-4 py-2 text-xs">
                                        {{ Str::after($notification->image, 'notifications/') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- 削除ボタン -->
                    <div class="mt-4 mb-4 flex justify-end">
                        <button id="delete-btn"
                            class="ms-3 bg-red-500 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-800 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            disabled>削除</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
