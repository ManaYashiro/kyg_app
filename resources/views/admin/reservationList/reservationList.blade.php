<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('予約一覧') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm border border-gray-800 border-r-0 border-b-0">
        <div class="p-6 text-gray-900">
            <div class="overflow-x-auto mt-4">
                @if (session('success'))
                    <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="GET" action="{{ route('admin.reservationList.index') }}" class="mb-4">
                    <div class="flex items-center gap-4">
                        <!-- 予約フィルター -->
                        <div>
                            <label for="appoint_number" class="block text-sm font-medium text-gray-700">予約</label>
                            <input type="text" name="appoint_number" id="appoint_number"
                                class="border-gray-300 rounded-md shadow-sm" value="{{ request('appoint_number') }}">
                        </div>

                        <!-- 名前フィルター -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">名前</label>
                            <input type="text" name="name" id="name"
                                class="border-gray-300 rounded-md shadow-sm" value="{{ request('name') }}">
                        </div>

                        <!-- 検索ボタン -->
                        <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md"
                            style="margin-top: 18px;">Filter</button>
                    </div>
                </form>

                <table class="min-w-full table-auto border-collapse" style="border: 1px solid #ccc;">
                    <!-- ヘッダー部分 -->
                    <thead class="bg-gray-200 sticky top-0 z-10">
                        <tr>
                            <th class="px-4 py-2 text-left" style="width: 5%;">予約番号</th>
                            <th class="px-4 py-2 text-left" style="width: 15%;">予約日時</th>
                            <th class="px-4 py-2 text-left" style="width: 15%;">名前</th>
                        </tr>
                    </thead>
                    <!-- ボディ部分 -->
                    <tbody>
                        @foreach ($reservationlists as $reservationlist)
                            <tr onclick="window.location='{{ route('admin.reservationList.edit', $reservationlist->id) }}'"
                                class="clickable-row" style="cursor: pointer;">
                                <td class="border px-4 py-2 text-xs">{{ $reservationlist->appoint_number }}</td>
                                <td class="border px-4 py-2 text-xs">{{ $reservationlist->reservation_datetime }}</td>
                                <td class="border px-4 py-2 text-xs">{{ $reservationlist->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- ページネーション -->
                <div class="mt-4">
                    {{ $reservationlists->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>
