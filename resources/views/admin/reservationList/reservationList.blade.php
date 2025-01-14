<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('予約一覧') }}
        </h2>
    </x-slot>

    <div class="bg-white h-full overflow-hidden shadow-sm border border-gray-800 border-r-0 border-b-0">
        <div class="h-full overflow-y-auto p-2 md:p-6 text-gray-900">
            @if (session('success'))
                <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <div class="border border-gray-300 p-4">
                <form method="GET" action="{{ route('admin.reservationList.index') }}" class="w-full">
                    <div class="mb-4">
                        <h2 class="text-lg mb-2">予約一覧検索</h2>

                        <!-- キーワード検索 -->
                        <div class="mb-1">
                            <div class="flex items-center">
                                <label for="name" class="text-sm w-24">キーワード</label>
                                <input type="text" name="name" id="name"
                                    placeholder="作業カテゴリ、予約する作業、予約番号、お名前(カナ)、管理メモを入力"
                                    class="flex-1 border border-gray-300 p-1 text-sm"
                                    value="{{ request('name') }}">
                            </div>
                        </div>

                        <!-- 予約日範囲 -->
                        <div class="flex items-center">
                            <label class="text-sm w-24">予約日</label>
                            <div class="flex items-center gap-2">
                                <input type="date" name="date_from" id="date_from" class="border border-gray-300 p-1 text-sm" value="{{ request('date_from') }}">
                                <span>～</span>
                                <input type="date" name="date_to" id="date_to" class="border border-gray-300 p-1 text-sm" value="{{ request('date_to') }}">
                                <div class="ml-4 flex gap-2">
                                    <button type="button" id="today-button"
                                        class="bg-blue-500 text-white px-4 py-1 rounded text-sm hover:bg-blue-600">
                                        今日の予約
                                    </button>
                                    <button type="button" id="tomorrow-button"
                                        class="bg-blue-500 text-white px-4 py-1 rounded text-sm hover:bg-blue-600">
                                        明日の予約
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- 並び替えオプション -->
                        <div class="flex gap-8">
                            <!-- 立て／横並び -->
                            <div class="flex items-center">
                                <label class="text-sm w-24">並び替え</label>
                                <div class="flex items-center gap-4">
                                    <label for="order_new" class="text-sm">手続き日が</label>
                                    <div class="flex items-center gap-1">
                                        <input type="radio" id="order_new" name="order" value="new">
                                        <label for="order_new" class="text-sm">新しい順</label>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <input type="radio" id="order_old" name="order" value="old">
                                        <label for="order_old" class="text-sm">古い順</label>
                                    </div>
                                </div>
                            </div>

                            <!-- 予約日順 -->
                            <div class="flex items-center">
                                <label class="text-sm w-24">予約日が</label>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-1">
                                        <input type="radio" id="date_new" name="date_order" value="new"
                                                    {{ request()->get('date_order') === 'new' ? 'checked' : '' }}>
                                        <label for="date_new" class="text-sm">新しい順</label>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <input type="radio" id="date_old" name="date_order" value="old"
                                                     {{ request()->get('date_order') === 'old' ? 'checked' : '' }}>
                                        <label for="date_old" class="text-sm">古い順</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 検索 -->
                    <div class="flex justify-center items-center mt-4">
                        <label id="reset" class="text-sm w-auto mr-10 whitespace-nowrap" style="cursor: pointer;">検索条件をリセット</label>
                        <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            検索する
                        </button>
                    </div>
                </form>
            </div>
            <div
                class="my-3 pb-2 border border-t-0 border-l-0 border-r-0 border-b-gray-400 flex justify-between items-center">
                <span class="font-bold">予約一覧</span>
                <div class="flex gap-2 justify-center items-center w-[250px]">
                    <x-buttons.actionbutton id="download-csv-btn" name="CSVでダウンロード" type="button" class="text-sm p-2" divClass="grow-[2]"
                        url="{{ route('admin.reservationList.downloadReservationsAsCSV', request()->query()) }}" />
                </div>
            </div>
            <div class="flex justify-end items-center mb-4">
            <!-- ページネーション -->
                <div class="mt-4">
                    {{ $reservationlists->appends(request()->query())->links('vendor.pagination.admin') }}
                </div>
            </div>
            <!-- テーブル -->
            <table id="result-table" class="min-w-full table-auto border-collapse" style="border: 1px solid #ccc;">
                <thead class="bg-gray-200 top-0 z-10">
                    <tr>
                        <th class="px-4 py-2 text-left" style="width: 5%;">
                            <input type="checkbox" id="select-all" class="select-all-checkbox">
                        </th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 8%;">予約番号</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 15%;">予約日時</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 10%;">顧客名</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 10%;">作業カテゴリ</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 10%;">予約する作業</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 10%;">備考欄</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 10%;">予約状態</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 20%;">管理メモ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservationlists as $reservationlist)
                        <tr id="click" class="clickable-row-reservation" style="cursor: pointer;">
                            <td class="border px-4 py-2 text-xs">
                                <input type="checkbox" id="checkbox-id" class="id-checkbox" data-id="{{ $reservationlist->id }}">
                            </td>
                            <td class="border px-4 py-2 text-xs">{{ $reservationlist->reservation_number }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $reservationlist->reservation_datetime }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $reservationlist->customer_name }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $reservationlist->inspection_type }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $reservationlist->reservation_task_id }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $reservationlist->remarks }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $reservationlist->status_text }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $reservationlist->admin_notes }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @section('styles')
    @endsection
    @push('scripts')
        @vite(['resources/js/modules/appointments/button.js'])
    @endpush
</x-admin-app-layout>
