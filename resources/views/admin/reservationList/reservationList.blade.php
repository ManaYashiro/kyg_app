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
            <span class="font-bold">予約一覧</span>
            <div class="border border-gray-300 p-4 justify-center mt-7">
                <form method="GET" action="{{ route('admin.reservationList.index') }}" class="mx-auto w-full max-w-4xl">
                    <div class="flex justify-between gap-6">
                        <div class="w-full">
                            <span class="mb-3">予約一覧検索</span>
                            <!-- キーワード検索  -->
                            <div class="flex items-center gap-4 mb-4 mt-3">
                                <label for="name" class="text-xs font-medium text-gray-700 w-20">キーワード</label>
                                <input type="text" name="name" id="name"
                                    placeholder="作業カテゴリ、予約する作業、予約番号、お名前(カナ)、管理メモを入力"
                                    class="block w-2/3 border-gray-300 shadow-sm text-xs" value="{{ request('name') }}">

                            </div>

                            <!-- 予約日範囲 -->
                            <div class="flex items-center mb-4">
                                <label class="text-xs font-medium text-gray-700 w-24">予約日</label>
                                <div class="flex items-center gap-2">
                                    <input type="text" name="date_from" id="date_from"
                                        class="datepicker border border-gray-300 p-1 text-sm"
                                        value="{{ request('date_from') }}">
                                    <span>～</span>
                                    <input type="text" name="date_to" id="date_to"
                                        class="datepicker border border-gray-300 p-1 text-sm"
                                        value="{{ request('date_to') }}">
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
                            <div class="flex gap-14 mb-4">
                                <!-- 立て／横並び -->
                                <div class="flex items-center w-1/2">
                                    <label for="order_new" class="text-xs font-medium text-gray-700 w-1/4">手続き日</label>
                                    <input type="radio" id="order_new" name="update_order" value="new"
                                        class="mr-4" {{ request('update_order') === 'new' ? 'checked' : '' }}>
                                    <div class="flex items-center">
                                        <label for="order_new" class="mr-2 text-xs">新しい順</label>
                                    </div>

                                    <input type="radio" id="order_old" name="update_order" value="old"
                                        class="mr-4" {{ request('update_order') === 'old' ? 'checked' : '' }}> <label
                                        for="order_old" class="mr-2 text-xs">古い順</label>
                                </div>

                                <!-- 予約日順 -->
                                <div class="flex items-center w-1/2">
                                    <label class="text-xs font-medium text-gray-700 w-1/4">予約日</label>
                                    <input type="radio" id="date_new" name="date_order" value="new" class="mr-4"
                                        {{ request()->get('date_order') === 'new' ? 'checked' : '' }}>
                                    <div class="flex items-center">
                                        <label for="date_new" class="mr-2 text-xs">新しい順</label>
                                    </div>
                                    <input type="radio" id="date_old" name="date_order" value="old" class="mr-4"
                                        {{ request()->get('date_order') === 'old' ? 'checked' : '' }}>
                                    <div class="flex items-center">
                                        <label for="date_old" class="mr-2 text-xs">古い順</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-center mt-4">
                        <label id="reset"
                            class="text-sm w-auto mr-10 whitespace-nowrap cursor-pointer">検索条件をリセット</label>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">検索する</button>
                    </div>
                </form>
            </div>
            <div
                class="my-3 pb-2 border border-t-0 border-l-0 border-r-0 border-b-gray-400 flex justify-between items-center">
                <span class="font-bold">予約一覧</span>
                <div class="flex gap-2 justify-center items-center w-[150px]">
                    <x-buttons.actionbutton id="download-csv-btn" name="CSVでダウンロード" type="button" class="text-sm p-2"
                        divClass="grow-[2]"
                        url="{{ route('admin.reservationList.downloadReservationsAsCSV', request()->query()) }}" />
                </div>
            </div>
            <div class="flex justify-between items-center mb-4">
                <!-- selectボックスと適応ボタン -->
                <div class="flex items-center space-x-4">
                    <!-- selectボックス -->
                    <div class="flex-1 max-w-xs">
                        <select id="selectAnAction" name="example"
                            class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">操作を選択</option>
                            <option value="cancel_reservations">チェックした予約／仮予約をキャンセル</option>
                        </select>
                    </div>

                    <!-- 適応ボタン -->
                    <button type="button" id="apply-btn"
                        class="bg-blue-500 text-white px-4 py-2 rounded text-sm hover:bg-blue-600">
                        適応
                    </button>
                </div>

                <!-- ページネーション -->
                <div>
                    {{ $reservationlists->appends(request()->query())->links('vendor.pagination.admin') }}
                </div>
            </div>
            <!-- テーブル -->
            <table id="result-table" class="min-w-full table-auto border-collapse" style="border: 1px solid #ccc;">
                <thead class="bg-gray-200 top-0 z-10">
                    <tr>
                        <th class="px-4 py-2 text-left" style="width: 5%;">
                            <input type="checkbox" id="select-all-reservation"
                                class="select-all-reservation-checkbox">
                        </th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 6%;">予約番号</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 10%;">予約日時</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 6%;">顧客名</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 8%;">作業カテゴリ</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 12%;">予約する作業</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 10%;">備考欄</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 5%;">予約状態</th>
                        <th class="px-4 py-2 text-left text-xs" style="width: 15%;">管理メモ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservationlists as $reservationlist)
                        <tr id="click" class="clickable-row-reservation" style="cursor: pointer;">
                            <td class="border px-4 py-2 text-xs">
                                <input type="checkbox" id="checkbox-id" class="reservation-checkbox"
                                    data-id="{{ $reservationlist->id }}">
                            </td>
                            <td class="border px-4 py-2 text-xs">{{ $reservationlist->reservation_number }}</td>
                            <td class="border px-4 py-2 text-xs">
                                {{ \Carbon\Carbon::parse($reservationlist->reservation_datetime)->format('Y/m/d H:i') }}
                            </td>
                            <td class="border px-4 py-2 text-xs">{{ $reservationlist->customer_name }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $reservationlist->inspection_type }}</td>
                            <td class="border px-4 py-2 text-xs">{{ $reservationlist->reservation_name }}</td>
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
        @vite(['resources/js/modules/appointments/admin-form.js'])
    @endpush
</x-admin-app-layout>
