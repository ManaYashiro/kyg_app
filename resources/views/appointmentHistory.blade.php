<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment Hisotry') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto mt-4">
                        @if (session('success'))
                            <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="overflow-x-auto mt-4">
                            @if (session('success'))
                                <div class="bg-green-200 text-green-700 p-2 rounded mb-4" id="success-message">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="mb-4">
                                <h2 class="text-lg font-semibold">現在予約中のもの</h2>
                                <table class="min-w-full table-auto border-collapse mt-2"
                                    style="border: 1px solid #ccc;">
                                    <tbody>
                                        @foreach ($filteredGroupedAppointments as $appointNumber => $appointmentsGroup)
                                            <!-- グループ内に現在の日時以降の予約があれば表示 -->
                                            @if ($appointmentsGroup->count() > 0)
                                                <thead class="sticky top-0 z-10">
                                                    <tr>
                                                        <th class="border px-4 py-2 text-left" colspan="3"
                                                            style="font-size: 1rem; font-weight: bold;">
                                                            予約番号: {{ $appointNumber }}
                                                        </th>
                                                    </tr>

                                                    <tr>
                                                        <th class="px-4 py-2 text-left bg-gray-200 "
                                                            style="width: 10%;">予約番号</th>
                                                        <th class="px-4 py-2 text-left bg-gray-200 " style="width: 8%;">
                                                            台数</th>
                                                        <th class="px-4 py-2 text-left bg-gray-200 "
                                                            style="width: 20%;">予約日時</th>
                                                    </tr>
                                                </thead>

                                                @foreach ($appointmentsGroup as $appointment)
                                                    <tr onclick="window.location='{{ route('appointmentList.edit', ['appointmentList' => $appointNumber]) }}'"
                                                        class="clickable-row" style="cursor: pointer;">
                                                        <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                                            {{ $appointment->appoint_number }}
                                                        </td>

                                                        {{-- 台数: グループ内で最大のsort_numberを取得 --}}
                                                        <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                                            {{ $appointmentsGroup->max('sort_number') }} 台
                                                        </td>

                                                        {{-- 予約日時: 予約日時を表示 --}}
                                                        <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                                            {{ $appointment->reservation_datetime }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <form method="GET" action="{{ route('appointmentList.index') }}" class="mb-6">
                                <div class="flex items-center gap-4 mt-6">
                                    <!-- 日付並び替え -->
                                    <div>
                                        <label for="sort_date"
                                            class="block text-sm font-medium text-gray-700">日付</label>
                                        <select name="sort_date" id="sort_date"
                                            class="border-gray-300 rounded-md shadow-sm">
                                            <option value="desc"
                                                {{ request('sort_date') == 'desc' ? 'selected' : '' }}>新しい順</option>
                                            <option value="asc"
                                                {{ request('sort_date') == 'asc' ? 'selected' : '' }}>古い順</option>
                                        </select>
                                    </div>

                                    <!-- 予約番号フィルター -->
                                    <div>
                                        <label for="appoint_number"
                                            class="block text-sm font-medium text-gray-700">予約番号</label>
                                        <input type="text" name="appoint_number" id="appoint_number"
                                            class="border-gray-300 rounded-md shadow-sm"
                                            value="{{ request('appoint_number') }}" placeholder="予約番号で検索">
                                    </div>

                                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md"
                                        style="margin-top: 18px;">フィルタ</button>
                                </div>
                            </form>

                            <table class="min-w-full table-auto border-collapse" style="border: 1px solid #ccc;">
                                <!-- ヘッダー部分 -->
                                <thead class="bg-gray-200 sticky top-0 z-10">
                                    <tr>
                                        <th class="px-4 py-2 text-left" style="width: 10%;">予約番号</th>
                                        <th class="px-4 py-2 text-left" style="width: 8%;">台数</th>
                                        <th class="px-4 py-2 text-left" style="width: 20%;">予約日時</th>
                                    </tr>
                                </thead>

                                <!-- ボディ部分 -->
                                <tbody>
                                    @foreach ($appointments as $appointNumber => $appointmentsGroup)
                                        <tr onclick="window.location='{{ route('appointmentList.edit', ['appointmentList' => $appointNumber]) }}'"
                                            class="clickable-row" style="cursor: pointer;">
                                            <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                                {{ $appointNumber }}
                                            </td>

                                            {{-- 台数: グループ内で最大のsort_numberを取得 --}}
                                            <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                                {{ $appointmentsGroup->max('sort_number') }} 台
                                            </td>

                                            {{-- 予約日時: グループ内の最初の予約の予約日時を取得 --}}
                                            <td class="border px-4 py-2" style="font-size: 0.75rem;">
                                                {{ $appointmentsGroup->first()->reservation_datetime }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>
